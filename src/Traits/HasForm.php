<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * Used in conjunction with the UsesForm interface
 * @mixin Model
 * @mixin UsesForm
 */
trait HasForm
{
    protected Form $form;

    // Form
    abstract public function viewRoute(): string;

    /** @return class-string<Form> */
    public static function formClass(): string
    {
        /** @var class-string<Form>[] $forms */
        $forms = config('form-builder.forms', []);
        $modelClass = static::class;

        foreach ($forms as $formClass) {
            if ($formClass::modelClass() === $modelClass) {
                return $formClass;
            }
        }

        throw new FormNotFound("No form has been registered for the \"$modelClass\" model");
    }

    public static function newForm(): Form
    {
        $model = new static();

        return $model->form();
    }

    public function form(): Form
    {
        if (isset($this->form) === false) {
            $formClass = $this->formClass();

            Session::put($formClass::key(), $this);
            $this->form = new $formClass();
        }

        return $this->form;
    }

    public function modelName(): string
    {
        return Str::title(
            class_basename($this),
        );
    }

    // Instantiation
    public static function makeForForm(): UsesForm
    {
        /** @var UsesForm $model */
        $model = new static();

        return $model;
    }

    // Draft
    public function draftIsEnabled(): bool
    {
        return true;
    }

    public function draftIsValid(): true|string
    {
        return true;
    }

    public function saveAsDraft(): void
    {
        $this->save();
    }

    // Submit
    public function submitIsValid(): true|string
    {
        return true;
    }

    public function saveAndSubmit(): void
    {
        $this->save();
    }
}
