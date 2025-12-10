<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
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

    public function view(?string $blade = null): View
    {
        return view($blade ?? 'form-builder::view')
            ->with('edit', Link::make(
                'Edit ' . $this->modelName(),
                $this->form()->editRoute(),
            ))
            ->with('model', $this)
            ->with(
                'summary',
                $this->form()
                    ->tasks()
                    ->summarise(false, false),
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

    public static function formRoute(?string $id = null): string
    {
        $formClass = static::formClass();

        return $id !== null
            ? route('forms.edit', [$formClass::key(), $id])
            : route('forms.new', $formClass::key());
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
        $tasks = $this->form()->tasks();
        $taskClasses = $tasks->items();
        $issues = [];

        foreach ($taskClasses as $taskClass) {
            $task = $tasks->makeItem($taskClass);
            $status = $task->status();

            if (
                $status !== State::Completed
                && $status !== State::NotRequired
            ) {
                $issues[] = $task->label();
            }
        }

        return empty($issues) === false
            ? 'The following tasks need to be completed: ' . implode(', ', $issues)
            : true;
    }

    public function saveAndSubmit(): void
    {
        $this->save();
    }
}
