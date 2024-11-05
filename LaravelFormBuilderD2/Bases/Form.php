<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormExpiredException;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Begin;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Check;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Finish;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasItems;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasKey;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

abstract class Form
{
    use HasItems;
    use HasKey;

    public const string EDIT = 'edit';

    public const string NEW = 'new';

    public const string REVIEW = 'review';

    public const array MODES = [
        self::EDIT,
        self::NEW,
        self::REVIEW,
    ];

    /** @var bool Whether the Form can be saved without submitting */
    protected bool $enableSaving = false;

    // Setup
    /** @return string Route to where the User should go when quitting the Form */
    abstract protected function quitFormRoute(): string;

    public function __construct(bool $populate = true)
    {
        if ($populate === true) {
            $this->populateItems();
        }
    }

    /** @return RedirectResponse Begin or resume a Form session */
    public function start(): RedirectResponse
    {
        if (Session::has(static::KEY) === true) {
            $stored = static::load(static::KEY);

            if ($this->model->getKey() === $stored->getKey()) {
                return redirect($this->resumeRoute());
            }
        }

        return $this->fresh();
    }

    /** @return View Show a "Resume" Screen which allows Users to restore their session */
    public function resume(): View
    {
        $resumeClass = $this->resumeClass();

        return new $resumeClass($this, $this->model);
    }

    /** @return RedirectResponse Clear out the current session and start anew */
    public function fresh(): RedirectResponse
    {
        Session::put(static::KEY, $this->model);

        $route = $this->model->exists === true
            ? $this->checkRoute()
            : $this->beginRoute();

        return redirect($route);
    }

    /** @return View Show a "Begin" screen which introduces the User to the form */
    public function begin(): View
    {
        $beginClass = $this->beginClass();

        return new $beginClass($this, $this->model);
    }

    /** @return View Show the selected Item */
    public function item(): View {}

    /** @return View Show a "Check" screen which allows Users to review their answers */
    public function check(): View
    {
        $checkClass = $this->checkClass();

        return new $checkClass($this, $this->model);
    }

    /** @return RedirectResponse Submit the User's answers */
    public function submit(): RedirectResponse
    {
        if ($this->canSubmit() !== true) {
            // TODO Validation message
            $redirect = redirect($this->checkRoute())->withErrors('Submit validation failed');
            throw new HttpResponseException($redirect);
        }

        $this->model->save();
        Session::flash(static::KEY, $this->model);

        return redirect($this->finishRoute());
    }

    /** @return RedirectResponse Save the User's answers without submitting, if enabled */
    public function save(): RedirectResponse
    {
        if ($this->canSave() !== true) {
            // TODO Validation message
            $redirect = redirect($this->checkRoute())->withErrors('Save validation failed');
            throw new HttpResponseException($redirect);
        }

        return $this->submit();
    }

    /** @return View Show a "Finish" screen which confirms the Form was submitted */
    public function finish(): View
    {
        $finishClass = $this->finishClass();

        return new $finishClass($this, $this->model);
    }

    /** @return RedirectResponse Clear the Form session and quit */
    public function exit(): RedirectResponse
    {
        Session::forget(static::KEY);

        return redirect($this->quitFormRoute());
    }

    // Model
    /** @return bool Whether the Model is valid for saving without submitting */
    public function canSave(): bool
    {
        return $this->enableSaving;
    }

    /** @return bool Whether the Model is valid for submitting */
    public function canSubmit(): bool
    {
        return true;
    }

    /** @return class-string<Model|HasForm> The class name of the Model associated with this Form */
    protected static function modelClass(): string
    {
        $key = static::class;
        $forms = config('form-builder.forms', []);

        if (array_key_exists($key, $forms) === false) {
            throw new FormNotFoundException("The \"$key\" form has not been registered");
        }

        return $forms[$key];
    }

    // Object Class Names
    /** @return class-string<Check> The class name of the "Check" Screen */
    protected function checkClass(): string
    {
        // TODO Default screen
        return '';
    }

    /** @return class-string<Resume> The class name of the "Resume" Screen */
    protected function resumeClass(): string
    {
        // TODO Default screen
        return '';
    }

    /** @return ?class-string<Begin> The class name of the "Begin" Screen, if used */
    protected function beginClass(): ?string
    {
        return null;
    }

    /** @return ?class-string<Finish> The class name of the "Finish" Screen, if used */
    protected function finishClass(): ?string
    {
        return null;
    }

    // Routing
    /** @return string Route to the "Start" action */
    public function startRoute(): string
    {
        return route('form-builder.start', [static::KEY, $this->model]);
    }

    /** @return string Route to the "Resume" action */
    public function resumeRoute(): string
    {
        return route('form-builder.resume', [static::KEY, $this->model]);
    }

    /** @return string Route to the "Fresh" action */
    public function freshRoute(): string
    {
        return route('form-builder.fresh', [static::KEY, $this->model]);
    }

    /** @return string Route to the "Begin" Screen, if enabled, or the first Item */
    public function beginRoute(): string
    {
        $beginClass = $this->beginClass();

        return $beginClass !== null
            ? route('form-builder.begin', [static::KEY])
            : $this->getFirstItem()->route();
    }

    /** @return string Route to an Item */
    public function itemRoute(array $path): string
    {
        return $this->getItemAt($path)->route();
    }

    /** @return string Route to the next Item or Screen */
    public function nextRoute(string $itemKey): string
    {
        // TODO traverse items to find next
        // Could be within item, fork, task, or to a screen
        return '';
    }

    /** @return string Route to the previous Item or Screen */
    public function previousRoute(string $itemKey): string
    {
        // TODO traverse items to find previous
        // Could be within item, fork, task, or to a screen
        return '';
    }

    /** @return string Route to the "Check" Screen */
    public function checkRoute(): string
    {
        return route('form-builder.check', [static::KEY]);
    }

    /** @return string Route to the "Submit" action */
    public function submitRoute(): string
    {
        return route('form-builder.submit', static::KEY);
    }

    /** @return string Route to the "Save" action, if enabled, or the "Submit" action */
    public function saveRoute(): string
    {
        return $this->enableSaving === true
            ? route('form-builder.save', static::KEY)
            : $this->submitRoute();
    }

    /** @return string Route to the "Finish" Screen, if enabled, or the "Exit" action */
    public function finishRoute(): string
    {
        $finishClass = $this->finishClass();

        return $finishClass !== null
            ? route('form-builder.finish', [static::KEY])
            : $this->exitRoute();
    }

    /** @return string Route to the "Exit" action */
    public function exitRoute(): string
    {
        return route('form-builder.exit', static::KEY);
    }
}

/*
    public function parseRoute(array $route): Question
    {
        $currentKey = array_pop($route);

        foreach ($this->questions as $question) {
            if ($currentKey === $question::KEY) {
                ** @var FormItem $item *
                $item = new $question($this);

                return is_a($item, Question::class) !== true
                    ? $item->parseRoute($route)
                    : $item;
            }
        }
    }

    public function previousRoute(): string
    {
        // If first key in parent, call parent previous
    }
 */
