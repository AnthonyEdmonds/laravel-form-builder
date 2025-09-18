<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\SkipNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;

abstract class Question extends Item implements ItemInterface, UsesStates, CanRender
{
    use HasStates;
    use Renderable;

    // Setup
    final public function __construct(
        public Form $form,
        public Task $task,
    ) {
        parent::__construct();
    }

    // Item
    public function label(): string
    {
        $fields = $this->fields();

        if (empty($fields) === true) {
            return 'Empty question';
        }

        $firstKey = array_key_first($fields);

        return $fields[$firstKey]['label'];
    }

    public function route(): string
    {
        return route('forms.task.questions.show', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);
    }

    // UsesStates
    public function hasError(): bool
    {
        return $this->isValid() === false;
    }

    public function isComplete(): bool
    {
        return $this->isValid() === true;
    }

    public function hasNotBeenStarted(): bool
    {
        return $this->hasAnyAnswers() === false;
    }

    // CanRender
    public function actions(): array
    {
        $actions = [
            $this->saveLabel() => $this->saveRoute(),
        ];

        if ($this->skipIsEnabled() === true) {
            $actions[$this->skipLabel()] = $this->skipRoute();
        }

        $actions['Back'] = $this->task->previousItem($this->key);
        $actions['Return to task'] = $this->task->route();
        $actions['Exit'] = $this->form->exitRoute();

        return $actions;
    }

    public function blade(): string
    {
        return 'form-builder::question';
    }

    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->form->tasks()->label() => $this->form->tasks()->route(),
            $this->task->label() => $this->task->route(),
            $this->label() => $this->route(),
        ];
    }

    public function title(): string
    {
        return $this->label();
    }

    // Fields
    /**
     * @return array<string, array<string, string|int|bool>> A list of keyed fields with options
     * [
     *     'name' => [
     *         'hint' => 'Provide their full name',
     *         'label' => 'What is their name?',
     *         'optional' => false,
     *     ],
     * ]
     * TODO Move to readme
     */
    abstract public function fields(): array;

    public function blankAnswerLabel(string $fieldKey): string
    {
        return 'Not given';
    }

    public function formatAnswer(string $fieldKey): string
    {
        return $this->getAnswer($fieldKey)
            ?? $this->blankAnswerLabel($fieldKey);
    }

    public function formatFields(): array
    {
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            $fields[$key]['answer'] = $this->getAnswer($key);
        }

        return $fields;
    }

    public function formatted(): array
    {
        $formatted = [];
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            $formatted[$key] = $this->formatAnswer($key);
        }

        return $formatted;
    }

    public function getAnswer(string $fieldKey): int|string|float|bool|null
    {
        return $this->form->model->$fieldKey;
    }

    public function hasAnswer(string $fieldKey): bool
    {
        return array_key_exists(
            $fieldKey,
            $this->form->model->getAttributes(),
        ) === true;
    }

    public function hasAnyAnswers(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            if ($this->hasAnswer($key) === true) {
                return true;
            }
        }

        return false;
    }

    public function hasAllAnswers(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            if ($this->hasAnswer($key) === false) {
                return false;
            }
        }

        return true;
    }

    public function isOptional(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $field) {
            if (
                array_key_exists('optional', $field) === false
                || $field['optional'] === false
            ) {
                return false;
            }
        }

        return true;
    }

    // Validation
    /** @returns class-string<FormRequest> */
    abstract public function formRequest(): string;

    public function isValid(): bool
    {
        $values = [];
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            $values[$key] = $this->form->model->$key;
        }

        try {
            request()->merge($values);
            $this->validate();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }

    public function validate(): void
    {
        request()->merge([
            'model' => $this->form->model,
        ]);

        app($this->formRequest());
    }

    // Actions
    public function show(): View
    {
        return $this->with('fields', $this->formatFields());
    }

    public function save(FormRequest $formRequest): RedirectResponse
    {
        $this->validate();
        $this->applySave($formRequest);
        Session::put($this->form->key, $this->form->model);

        if (
            $this->loopingIsEnabled() === true
            && $this->shouldLoop() === true
        ) {
            return Redirect::to(
                $this->route(),
            );
        }

        return $this->task->nextItem($this->key);
    }

    public function applySave(FormRequest $formRequest): void
    {
        $fields = $this->fields();

        foreach ($fields as $field => $value) {
            $this->form->model->$field = $formRequest->get($field);
        }
    }

    public function loopingIsEnabled(): bool
    {
        return false;
    }

    public function shouldLoop(): bool
    {
        return true;
    }

    public function saveLabel(): string
    {
        return 'Save and continue';
    }

    public function saveRoute(): string
    {
        return route('forms.task.questions.save', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);
    }

    public function skip(FormRequest $formRequest): RedirectResponse
    {
        if ($this->skipIsEnabled() === false) {
            throw new SkipNotAllowed('You cannot skip this question');
        }

        $this->applySkip($formRequest);
        Session::put($this->form->key, $this->form->model);

        return $this->task->nextItem($this->key);
    }

    public function applySkip(FormRequest $formRequest): void
    {
        //
    }

    public function skipIsEnabled(): bool
    {
        return false;
    }

    public function skipLabel(): string
    {
        return 'Skip and continue';
    }

    public function skipRoute(): string
    {
        return route('forms.task.questions.skip', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);
    }
}
