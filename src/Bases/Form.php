<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormExpiredException;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

abstract class Form extends Base
{
    /** @return true|string True, or why the Form cannot be accessed */
    abstract public function authorise(): true|string;

    /** @return Task[] The Tasks contained within this Form */
    abstract public function tasks(): array;

    // Setup
    /** @param UsesForm $model The Model instance for the current Form session */
    public function __construct(public readonly UsesForm $model)
    {
        $authorised = $this->authorise();
        if ($authorised !== true) {
            throw new AuthorizationException("This form cannot be accessed; $authorised");
        }
    }

    // Classes
    /** @return class-string<Form> The registered Form for the given key */
    public static function formClassByKey(string $formKey): string
    {
        $forms = config('form-builder.forms', []);

        /**
         * @var class-string<Form> $formClass
         * @var class-string<UsesForm> $modelClass
         */
        foreach ($forms as $formClass => $modelClass) {
            if ($formClass::key() === $formKey) {
                return $formClass;
            }
        }

        throw new FormNotFoundException("No form has been registered with the key \"$formKey\"");
    }

    /** @return class-string<Form> The registered Form for the Model */
    public static function formClassByModel(string $modelClass): string
    {
        $forms = config('form-builder.forms', []);
        $formClass = array_search($modelClass, $forms);

        return $formClass === false
            ? throw new FormNotFoundException("No form has been registered for \"$modelClass\"")
            : $formClass;
    }

    /** @return class-string<Model|HasForm> The registered Model for the Form */
    public static function modelClass(): string
    {
        $forms = config('form-builder.forms');
        $formClass = static::class;

        return array_key_exists($formClass, $forms) === false
            ? throw new FormNotFoundException("No model has been registered for \"$formClass\"")
            : $forms[$formClass];
    }

    // Actions
    /** @return Form Create a new Form instance */
    public static function new(string $formKey, ?string $modelKey = null): Form
    {
        $formClass = Form::formClassByKey($formKey);
        $modelClass = $formClass::modelClass();

        $model = $modelKey !== null
            ? $modelClass::findOrFail($modelKey)
            : new $modelClass();

        return new static($model);
    }

    /** @return Form Load the current Form session */
    public static function load(string $formKey): Form
    {
        if (Session::has($formKey) !== true) {
            throw new FormExpiredException('The form you are trying to access has expired. Please start again.');
        }

        return Session::get($formKey)->form();
    }

    // Tasks
    public function task(string $taskKey): Task
    {
        $tasks = $this->tasks();

        foreach ($tasks as $task) {
            if ($task::key() === $taskKey) {
                return $task;
            }
        }

        $formKey = static::key();
        throw new FormNotFoundException("No task has been registered for the \"$formKey\" form with the key \"$taskKey\"");
    }
}
