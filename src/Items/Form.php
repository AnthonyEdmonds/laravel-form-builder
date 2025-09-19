<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\DraftNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\ModelHelper;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/** @property UsesForm|Model $model */
abstract class Form extends Item implements ItemInterface
{
    use AuthorizesRequests;

    // Setup
    final public function __construct(
        public readonly UsesForm $model,
    ) {
        parent::__construct();

        $this->checkAccess();
    }

    /** @returns class-string<Form> */
    public static function classnameByKey(string $formKey): string
    {
        /** @var class-string<Form>[] $forms */
        $forms = config('form-builder.forms', []);

        foreach ($forms as $formClass) {
            if ($formClass::key() === $formKey) {
                return $formClass;
            }
        }

        throw new FormNotFound("No form has been registered with the key \"$formKey\"");
    }

    public static function load(string $formKey): Form
    {
        /** @var class-string<Form> $formClass */
        $formClass = static::classnameByKey($formKey);

        return new $formClass(
            SessionHelper::getFormSession($formKey),
        );
    }

    public function checkAccess(): void
    {
        //
    }

    // Item
    abstract public static function key(): string;

    public function label(): string
    {
        return $this->model->modelName() . ' form';
    }

    public function route(): string
    {
        return route('forms.new', $this->key);
    }

    // Flags
    public function confirmationIsEnabled(): bool
    {
        return true;
    }

    public function startIsEnabled(): bool
    {
        return true;
    }

    // Classes
    abstract public function tasks(): Tasks;

    public function confirmation(): Confirmation
    {
        return new Confirmation($this);
    }

    public function resume(): Resume
    {
        return new Resume($this);
    }

    public function start(): Start
    {
        return new Start($this);
    }

    public function summary(): Summary
    {
        return new Summary($this);
    }

    // Models
    /** @returns class-string<UsesForm> */
    abstract public static function modelClass(): string;

    // Actions
    public function draft(): RedirectResponse
    {
        if ($this->model->draftIsEnabled() === false) {
            throw new DraftNotAllowed('This form does not support saving as a draft');
        }

        $draftIsValid = $this->model->draftIsValid();
        if ($draftIsValid !== true) {
            return Redirect::back()->withErrors([
                'reason' => $draftIsValid,
            ]);
        }

        $this->model->saveAsDraft();
        SessionHelper::clearFormSession($this->key);

        return $this->exit();
    }

    public function draftLabel(): string
    {
        return 'Save as draft';
    }

    public function draftRoute(): string
    {
        return route('forms.draft', $this->key);
    }

    public static function edit(string $formKey, string $modelKey): RedirectResponse
    {
        /** @var class-string<Form> $formClass */
        $formClass = Form::classnameByKey($formKey);

        $modelHasSession = SessionHelper::modelHasSession($formKey, $modelKey) === true;

        $model = $modelHasSession === true
            ? SessionHelper::getFormSession($formKey)
            : ModelHelper::loadModelFromDatabase($formClass, $modelKey);

        if ($modelHasSession === false) {
            SessionHelper::setFormSession($formKey, $model);
        }

        $form = new $formClass($model);

        return Redirect::to(
            $modelHasSession === true
                ? $form->resume()->route()
                : $form->tasks()->route(),
        );
    }

    public function editRoute(): string
    {
        return route('forms.edit', [
            $this->key,
            $this->model->getKey(),
        ]);
    }

    public function exit(): RedirectResponse
    {
        return Redirect::to(
            $this->exitRoute(),
        );
    }

    public function exitLabel(): string
    {
        return 'Exit form';
    }

    public function exitRoute(): string
    {
        return route('/');
    }

    public static function new(string $formKey): RedirectResponse
    {
        /** @var class-string<Form> $formClass */
        $formClass = Form::classnameByKey($formKey);

        $model = ModelHelper::newModel($formClass);
        SessionHelper::setFormSession($formKey, $model);
        $form = new $formClass($model);

        return Redirect::to(
            $form->startIsEnabled() === true
                ? $form->start()->route()
                : $form->tasks()->route(),
        );
    }

    public function newRoute(): string
    {
        return route('forms.new', $this->key);
    }

    public function submit(): RedirectResponse
    {
        $submitIsValid = $this->model->submitIsValid();
        if ($submitIsValid !== true) {
            return Redirect::back()->withErrors([
                'reason' => $submitIsValid,
            ]);
        }

        $this->model->saveAndSubmit();
        Session::flash($this->key, $this->model);

        return Redirect::to(
            $this->confirmationIsEnabled() === true
                ? $this->confirmation()->route()
                : $this->model->viewRoute(),
        );
    }

    public function submitLabel(): string
    {
        return 'Submit';
    }

    public function submitRoute(): string
    {
        return route('forms.submit', $this->key);
    }
}
