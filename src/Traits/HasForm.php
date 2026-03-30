<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\AttributeMissing;
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
        $edit = $this->form()->canAccess() === false
            ? null
            : Link::make(
                'Edit ' . $this->modelName(),
                $this->form()->editRoute(),
            );

        return view($blade ?? 'form-builder::view')
            ->with('edit', $edit)
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

    public static function formRoute(Model|string|int|null $id = null): string
    {
        if (is_a($id, Model::class) === true) {
            $formClass = $id::formClass();
            $id = $id->getKey();
        } else {
            $formClass = static::formClass();
        }

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
        return $this->tasksAreComplete();
    }

    public function tasksAreComplete(): true|string
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

    // Answers
    public function blankAnswer(string $property): string
    {
        return 'Not provided';
    }

    public function formattedAnswer(string $property): mixed
    {
        return $this->getAnswer($property)
            ?? $this->blankAnswer($property);
    }

    public function hasAnswer(string $property): bool
    {
        return str_contains($property, '.') === true
            ? $this->relationHasAnswer($property)
            : array_key_exists($property, $this->attributes) === true;
    }

    public function rawAnswer(string $property): mixed
    {
        return $this->getAnswer($property)
            ?? null;
    }

    protected function getAnswer(string $property): mixed
    {
        return str_contains($property, '.') === true
            ? $this->relationAnswer($property)
            : $this->$property;
    }

    protected function getAnswerFromRelation(mixed $subject, string $property): mixed
    {
        if (
            is_a($subject, Model::class) === true
            && array_key_exists($property, $subject->getAttributes()) === true
        ) {
            return $subject->$property;
        }

        if (
            is_a($subject, Model::class) === true
            && $subject->isRelation($property) === true
        ) {
            return $subject->$property;
        }

        if (
            is_object($subject) === true
            && property_exists($subject, $property) === true
        ) {
            return $subject->$property;
        }

        if (
            is_array($subject) === true
            && array_key_exists($property, $subject) === true
        ) {
            return $subject[$property];
        }

        throw new AttributeMissing("Unable to find the \"$property\" attribute");
    }

    protected function relationAnswer(string $property): mixed
    {
        $parts = explode('.', $property);
        $subject = $this;

        foreach ($parts as $attribute) {
            try {
                $subject = $this->getAnswerFromRelation($subject, $attribute);
            } catch (AttributeMissing $exception) {
                return null;
            }
        }

        return $subject;
    }

    protected function relationHasAnswer(string $property): bool
    {
        $parts = explode('.', $property);
        $subject = $this;

        foreach ($parts as $attribute) {
            try {
                $subject = $this->getAnswerFromRelation($subject, $attribute);
            } catch (AttributeMissing $exception) {
                return false;
            }
        }

        return true;
    }
}
