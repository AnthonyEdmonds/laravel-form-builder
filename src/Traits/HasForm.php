<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

// TODO View in readme
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

    public function view(): View
    {
        return view('form-builder::view')
            ->with('edit', Link::make(
                'Edit ' . $this->modelName(),
                $this->form()->editRoute(),
            ))
            ->with('model', $this)
            ->with(
                'summary',
                $this->form()
                    ->tasks()
                    ->summarise(false),
            );
    }

    public function viewLabel(): string
    {
        return 'View ' . $this->modelName();
    }

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

        $modelClass = class_basename($modelClass);
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
            $this->form = new $formClass($this);
        }

        return $this->form;
    }

    public function modelName(): string
    {
        return Str::of(
            class_basename($this),
        )
            ->snake()
            ->replace('_', ' ')
            ->title();
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
