<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\MissingLabel;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\SkipNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanFormat;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanSummarise;
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

// TODO v2 Disable when in not required, cannot start
abstract class Question extends Item implements ItemInterface, UsesStates, CanRender, CanSummarise, CanFormat
{
    use HasStates;
    use Renderable;

    public bool $returnToSummary = false;

    // Setup
    final public function __construct(
        public Form $form,
        public Task $task,
    ) {
        parent::__construct();

        if (request()->query('return') === 'summary') {
            $this->returnToSummary = true;
        }
    }

    // Item
    public function label(): string
    {
        $fields = $this->fields();

        return match (true) {
            empty($fields) === true => 'Empty question',
            count($fields) > 1 => throw new MissingLabel('You must provide a label when a question has multiple fields'),
            default => $fields[0]->label,
        };
    }

    public function route(): string
    {
        $route = route('forms.task.questions.show', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);

        if ($this->returnToSummary === true) {
            $route .= '?return=summary';
        }

        return $route;
    }

    public function backLabel(): string
    {
        return $this->returnToSummary === true
            ? 'Back to check answers'
            : 'Previous question';
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
        return [
            'back' => Link::make(
                $this->backLabel(),
                $this->returnToSummary === true
                    ? $this->form->summary()->route() . "#{$this->task->key}"
                    : $this->task->previousItem($this->key)->getTargetUrl(),
            ),
            'task' => Link::make(
                $this->task->backLabel(),
                $this->task->route(),
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
        ];
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

    public function hideTitle(): bool
    {
        return count($this->fields()) === 1;
    }

    // Fields
    /** @returns Field[] */
    abstract public function fields(): array;

    public function blankAnswerLabel(string $fieldKey): string
    {
        return 'Not provided';
    }

    public function getFormattedAnswer(string $fieldKey): string
    {
        return $this->getRawAnswer($fieldKey)
            ?? $this->blankAnswerLabel($fieldKey);
    }

    public function getRawAnswer(string $fieldName): mixed
    {
        return $this->form->model->$fieldName;
    }

    public function hasAnswer(string $fieldName): bool
    {
        return array_key_exists(
            $fieldName,
            $this->form->model->getAttributes(),
        ) === true;
    }

    public function hasAnyAnswers(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $field) {
            if ($this->hasAnswer($field->name) === true) {
                return true;
            }
        }

        return false;
    }

    public function hasAllAnswers(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $field) {
            if ($this->hasAnswer($field->name) === false) {
                return false;
            }
        }

        return true;
    }

    public function isOptional(): bool
    {
        $fields = $this->fields();

        foreach ($fields as $field) {
            if ($field->optional === false) {
                return false;
            }
        }

        return true;
    }

    public function formatFields(): array
    {
        $fields = $this->fields();
        $isTitle = count($fields) === 1;

        foreach ($fields as $field) {
            $field->setValue(
                $this->getRawAnswer($field->name),
            );

            if ($isTitle === true) {
                $field->title();
            }
        }

        return $fields;
    }

    // Validation
    /** @returns class-string<FormRequest> */
    abstract public function formRequest(): string;

    public function isValid(): bool
    {
        $values = [];
        $fields = $this->fields();

        foreach ($fields as $field) {
            $values[$field->name] = $this->getRawAnswer($field->name);
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

    // CanSummarise
    public function summarise(bool $hasActions): array
    {
        return $this->makeSummaryItems($hasActions, true);
    }

    public function changeLabel(): string
    {
        return 'Change';
    }

    protected function makeSummaryItems(bool $hasActions, bool $backToSummary): array
    {
        $summary = [];

        $fields = $this->fields();
        foreach ($fields as $field) {
            $route = $this->route();
            if ($backToSummary === true) {
                $route .= '?return=summary';
            }

            $summary[$field->displayName] = [
                'label' => $field->displayName,
                'value' => $this->getFormattedAnswer($field->name),
            ];

            if ($hasActions === true) {
                $summary[$field->displayName]['colour'] = $this->statusColour()->value;
                $summary[$field->displayName]['status'] = $this->status()->value;
                $summary[$field->displayName]['actions'] = [
                    'change' => [
                        'label' => $this->changeLabel(),
                        'url' => $route,
                    ],
                ];
            }
        }

        return $summary;
    }

    // CanFormat
    public function format(): array
    {
        return $this->makeSummaryItems(true, false);
    }

    // Actions
    public function show(): View
    {
        $this
            ->with('fields', $this->formatFields())
            ->with('hideTitle', $this->hideTitle())
            ->with('save', Link::make(
                $this->saveLabel(),
                $this->saveRoute(),
            ));

        if ($this->skipIsEnabled() === true) {
            $this->with('skip', Link::make(
                $this->skipLabel(),
                $this->skipRoute(),
            ));
        }

        return $this;
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

        return $this->returnToSummary === true
            ? Redirect::to($this->form->summary()->route() . "#{$this->task->key}")
            : $this->task->nextItem($this->key);
    }

    public function applySave(FormRequest $formRequest): void
    {
        $fields = $this->fields();

        foreach ($fields as $field) {
            $attribute = $field->name;
            $this->form->model->$attribute = $formRequest->get($field->name);
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
        $route = route('forms.task.questions.save', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);

        if ($this->returnToSummary === true) {
            $route .= '?return=summary';
        }

        return $route;
    }

    public function skip(FormRequest $formRequest): RedirectResponse
    {
        if ($this->skipIsEnabled() === false) {
            throw new SkipNotAllowed('You cannot skip this question');
        }

        $this->applySkip($formRequest);
        Session::put($this->form->key, $this->form->model);

        return $this->returnToSummary === true
            ? Redirect::to($this->form->summary()->route() . "#{$this->task->key}")
            : $this->task->nextItem($this->key);
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
        $route = route('forms.task.questions.skip', [
            $this->form->key,
            $this->task->key,
            $this->key,
        ]);

        if ($this->returnToSummary === true) {
            $route .= '?return=summary';
        }

        return $route;
    }
}
