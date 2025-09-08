<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\ModelHelper;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

// TODO If editing answer from summary page, skip back to summary
// TODO If editing answer from task page, skip back to task
// TODO Enable saving? Probably handled by overriding save on model

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
        // TODO

        return $this->exit();
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

        return Redirect::route(
            $modelHasSession === true
                ? $form->resume()->route()
                : $form->tasks()->show(),
        );
    }

    public static function new(string $formKey): RedirectResponse
    {
        /** @var class-string<Form> $formClass */
        $formClass = Form::classnameByKey($formKey);

        $model = ModelHelper::newModel($formClass);
        SessionHelper::setFormSession($formKey, $model);
        $form = new $formClass($model);

        return Redirect::route(
            $form->startIsEnabled() === true
                ? $form->start()->route()
                : $form->tasks()->show(),
        );
    }

    public function submit(): RedirectResponse
    {
        // TODO

        if ($this->confirmationIsEnabled() === true) {
            return Redirect::route(
                $this->confirmation()->route(),
            );
        }

        return $this->exit();
    }

    // Exit
    public function exitRoute(): string
    {
        return route('/');
    }

    public function exit(): RedirectResponse
    {
        return Redirect::route(
            $this->exitRoute(),
        );
    }
}
