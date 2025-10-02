<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\QuestionNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanFormat;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanSummarise;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

abstract class Task extends ItemContainer implements UsesStates, CanRender, CanSummarise, CanFormat
{
    use HasStates;
    use Renderable;

    public ?string $group = null;

    protected ?array $questionStatuses = null;

    // Setup
    final public function __construct(
        public Form $form,
        public Tasks $tasks,
    ) {
        parent::__construct();
    }

    // Item
    public function route(): string
    {
        return route('forms.task.show', [
            $this->form->key,
            $this->key,
        ]);
    }

    public function backLabel(): string
    {
        return 'Back to task';
    }

    // Container
    /** @returns class-string<Question>[] */
    abstract public function questions(): array;

    /** @param Question $item */
    public function formatItem(ItemInterface $item): array
    {
        return $this->formatQuestion($item);
    }

    public function items(): array
    {
        return $this->questions();
    }

    /** @param class-string<Question> $itemClass */
    public function makeItem(string $itemClass): Question
    {
        return new $itemClass($this->form, $this);
    }

    public function question(string $questionKey): Question
    {
        /** @var ?Question $question */
        $question = $this->findItem($questionKey);

        return $question
            ?? throw new QuestionNotFound("No question has been registered on this form task with the key \"$questionKey\"");
    }

    protected function formatQuestion(Question $question): array
    {
        return $question->format();
    }

    // UsesStates
    public function checkStatus(): State
    {
        $this->getQuestionStatuses();

        return $this->matchStatus();
    }

    public function checkQuestionStatuses(): void
    {
        $this->resetQuestionStatuses();

        /** @var class-string<Question>[] $questions */
        $questions = $this->questions();

        foreach ($questions as $questionClass) {
            $question = new $questionClass($this->form, $this);

            $questionStatus = $question->status();
            $this->questionStatuses[$questionStatus->name]++;
            $this->questionStatuses['total']++;
        }
    }

    public function getQuestionStatuses(): array
    {
        if ($this->questionStatuses === null) {
            $this->checkQuestionStatuses();
        }

        return $this->questionStatuses;
    }

    public function hasError(): bool
    {
        $this->getQuestionStatuses();

        return $this->questionStatuses[State::ThereIsAProblem->name] > 0;
    }

    public function hasNotBeenStarted(): bool
    {
        $this->getQuestionStatuses();

        return $this->questionStatuses[State::NotYetStarted->name] === $this->questionStatuses['total'];
    }

    public function isComplete(): bool
    {
        $this->getQuestionStatuses();

        return $this->questionStatuses[State::Completed->name] === $this->questionStatuses['total'];
    }

    public function isInProgress(): bool
    {
        $this->getQuestionStatuses();

        return $this->questionStatuses[State::NotYetStarted->name] < $this->questionStatuses['total']
            && $this->questionStatuses[State::NotYetStarted->name] > 0;
    }

    protected function resetQuestionStatuses(): void
    {
        $this->questionStatuses = [
            State::NotRequired->name => 0,
            State::ThereIsAProblem->name => 0,
            State::Incomplete->name => 0,
            State::InProgress->name => 0,
            State::NotYetStarted->name => 0,
            State::CannotStartYet->name => 0,
            State::Completed->name => 0,
            State::Unknown->name => 0,
            'total' => 0,
        ];
    }

    // CanRender
    public function actions(): array
    {
        $tasks = $this->form->tasks();

        return [
            'back' => Link::make(
                $tasks->backLabel(),
                $tasks->route(),
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
        ];
    }

    public function blade(): string
    {
        return 'form-builder::task';
    }

    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->form->tasks()->label() => $this->form->tasks()->route(),
            $this->label() => $this->route(),
        ];
    }

    public function title(): string
    {
        return $this->label();
    }

    // CanSummarise
    public function summarise(bool $hasActions, bool $hasStatuses): array
    {
        $answers = [];

        if ($hasActions === true) {
            $hasActions = $this->canChange();
        }

        $questions = $this->questions();
        foreach ($questions as $questionClass) {
            $question = $this->makeItem($questionClass);
            $answers = array_merge(
                $answers,
                $question->summarise($hasActions, $hasStatuses),
            );
        }

        $summary = [
            'group' => $this->group,
            'id' => $this->key,
            'list' => $answers,
            'title' => $this->label(),
        ];

        if ($hasStatuses === true) {
            $summary['colour'] = $this->statusColour()->value;
            $summary['status'] = $this->status()->value;
        }

        if ($hasActions === true) {
            $summary['actions'] = [
                'change' => [
                    'label' => $this->changeLabel(),
                    'url' => $this->route(),
                ],
            ];
        }

        return $summary;
    }

    public function canChange(): bool
    {
        if ($this->canAccess() === false) {
            return false;
        }

        return match ($this->status()) {
            State::CannotStartYet,
            State::NotRequired => false,
            default => true,
        };
    }

    public function changeLabel(): string
    {
        return 'Change answers';
    }

    // CanFormat
    public function format(): array
    {
        return [
            'colour' => $this->statusColour()->value,
            'group' => $this->group,
            'hint' => $this->description(),
            'id' => $this->key,
            'label' => $this->label(),
            'status' => $this->status()->value,
            'url' => $this->route(),
        ];
    }

    // Actions
    public function show(): View
    {
        return $this
            ->with('colour', $this->statusColour()->value)
            ->with('group', $this->group)
            ->with(
                'questions',
                array_merge(
                    ...$this->formatItems(),
                ),
            )
            ->with('status', $this->status()->value);
    }
}
