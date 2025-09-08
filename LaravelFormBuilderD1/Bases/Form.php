<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormExpiredException;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Check;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Finish;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Begin;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasItems;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasKey;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

/*
 * TODO
 * Tests
 * Coverage
 * PHPStan
 * Merge back into library
 * GOV.UK adaptations
 */

abstract class Form
{
    use HasItems;
    use HasKey;

    public const string EDIT = 'edit';

    public const string NEW = 'new';

    public const string RESUME = 'resume';

    public const string REVIEW = 'review';

    public const string START = 'start';

    public const string SUBMIT  = 'submit';

    /** Whether Users have the option to save without submitting */
    public const bool SAVE_ENABLED = false;

    // Setup
    public function __construct()
    {
        $this->indexItems($this->model);
    }

    public function __wakeup(): void
    {
        $this->indexItems($this->model);
    }

    /** Create a new Form instance */
    public static function new(string $formKey, ?string $modelKey): Form
    {
        $forms = config('form-builder.forms', []);

        /**
         * @var class-string<Form> $formClass
         * @var class-string<Model|HasForm> $modelClass
         */
        foreach ($forms as $formClass => $modelClass) {
            if ($formClass::key() === $formKey) {
                $model = $modelKey !== null
                    ? $modelClass::findOrFail($modelKey)
                    : new $modelClass();

                return new $formClass($model);
            }
        }

        throw new FormNotFoundException("No form has been registered for \"$formKey\"");
    }

    // Model
    /**
     * @return Model|HasForm Load a Model from the current session
     * @noinspection PhpDocSignatureInspection
     */
    public static function getModelFromSession(string $formKey): Model
    {
        return Session::has($formKey) === true
            ? Session::get($formKey)
            : throw new FormExpiredException('Your form session has expired; you must start again.');
    }

    /** Store the Form Model into the current session */
    public function putModelIntoSession(): static
    {
        Session::put(static::key(), $this->model);
        return $this;
    }

    /** @return class-string<Model|HasForm> The class name of the Model associated with this Form */
    public function modelClass(): string
    {
        $formClass = static::class;
        $forms = config('form-builder.forms', []);

        return array_key_exists($formClass, $forms) === true
            ? $forms[$formClass]
            : throw new FormNotFoundException("No model has been registered for \"$formClass\"");
    }

    /** Override this method to customise how Models are saved */
    public function saveModel(): void
    {
        $this->submitModel();
    }

    /** Override this method to customise how Models are submitted */
    public function submitModel(): void
    {
        $this->model->save();
    }

    // Actions
    /** Start or resume a Form session */
    public function start(): RedirectResponse
    {
        if (Session::has(static::key()) === true) {
            $stored = $this::getModelFromSession(static::key());

            if ($this->model->getKey() === $stored->getKey()) {
                return redirect($this->resumeRoute());
            }
        }

        return $this->fresh();
    }

    /** Start a new Form session */
    public function fresh(): RedirectResponse
    {
        $this->putModelIntoSession();

        if (
            $this->model->exists === true
            && $this->checkScreen() !== null
        ) {
            return redirect($this->checkRoute());
        }

        $firstItemPath = $this->firstItemPath();
        return redirect($this->itemRoute($firstItemPath));
    }

    /** Save the Form and exit */
    public function save(): RedirectResponse
    {
        if (static::SAVE_ENABLED !== true) {
            return $this->submit();
        }

        $canSave = $this->model->canSave();
        if ($canSave !== true) {
            return back()->withErrors([
                'content' => $canSave,
            ]);
        }

        $this->saveModel();
        Session::forget(static::key());

        return redirect($this->exitRoute());
    }

    /** Submit the Form and exit */
    public function submit(): RedirectResponse
    {
        $canSubmit = $this->model->canSubmit();
        if ($canSubmit !== true) {
            return back()->withErrors([
                'content' => $canSubmit,
            ]);
        }

        $this->submitModel();
        Session::flash(static::key(), $this->model);

        $nextRoute = $this->finishScreen() !== null
            ? $this->finishRoute()
            : $this->exitRoute();

        return redirect($nextRoute);
    }

    // Screens
    /** @return ?class-string<Begin> Classname of the Begin screen, or null */
    public function beginScreen(): ?string
    {
        return null;
    }

    /** @return ?class-string<Check> Classname of the Check screen, or null */
    public function checkScreen(): ?string
    {
        return null;
    }

    /** @return ?class-string<Finish> Classname of the Finish screen, or null */
    public function finishScreen(): ?string
    {
        return null;
    }

    /** @return class-string<Resume> Classname of the Check screen, or null */
    public function resumeScreen(): string
    {
        return Resume::class;
    }

    /** Ask the User whether they want to resume their Form session */
    public function resume(): View
    {
        return $this->showScreen($this->resumeScreen(), '');
    }

    /** Show the Begin Screen if set, or skip to the first Item */
    public function begin(): View|RedirectResponse
    {
        return $this->showScreen($this->beginScreen(), $this->firstItemRoute());
    }

    /** Show the Begin Screen if set, or submit the Form */
    public function check(): View|RedirectResponse
    {
        return $this->showScreen($this->checkScreen(), $this->submitRoute());
    }

    /** Show the Finish Screen if set, or exit the Form */
    public function finish(): View|RedirectResponse
    {
        return $this->showScreen($this->finishScreen(), $this->exitRoute());
    }

    protected function showScreen(?string $screenClass, string $redirect): View|RedirectResponse
    {
        return $screenClass === null
            ? redirect($redirect)
            : new $screenClass($this, $this->model);
    }

    // Items
    /** Get the Item at a given path */
    public function getItem(string $path): Item
    {
        /** @var class-string<Item> $class */
        $class = $this->itemAtPath($path);
        return new $class($this, $this->model);
    }

    // Routes
    /** Where the form exits to */
    abstract public function exitRoute(): string;

    /** Link to start the Form; everything starts here! */
    public function startRoute(): string
    {
        return route('forms.start', static::key());
    }

    /** Link to view the Resume screen */
    public function resumeRoute(): string
    {
        return route('forms.resume', static::key());
    }

    /** Link to force a fresh Form session */
    public function freshRoute(): string
    {
        return route('forms.fresh', static::key());
    }

    /** Link to view the Begin screen, if set */
    public function beginRoute(): string
    {
        return route('forms.begin', static::key());
    }

    /** Link to view the Check screen, if set */
    public function checkRoute(): string
    {
        return route('forms.check', static::key());
    }

    public function saveRoute(): string
    {
        return route('forms.submit', static::key());
    }

    public function submitRoute(): string
    {
        return route('forms.submit', static::key());
    }

    /** Link to view the Check screen, if set */
    public function finishRoute(): string
    {
        return route('forms.finish', static::key());
    }

    /** Link to a specific Item at a given path */
    public function itemRoute(string $itemPath): string
    {
        return route('forms.items', [static::key(), $itemPath]);
    }

    /** Link to the first Item */
    public function firstItemRoute(): string
    {
        return $this->itemRoute($this->firstItemPath());
    }
}

// TODO Did not go to check when editing
