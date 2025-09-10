<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\QuestionNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

abstract class Task extends ItemContainer implements UsesStates, CanRender
{
    use HasStates;
    use Renderable;

    protected array $questionStatuses = [
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

    // TODO Must support multiple fields
    protected function formatQuestion(Question $question): array
    {
        return [
            'fields' => $question->formatFields(),
            'link' => $question->route(),
        ];
    }

    // UsesStates
    public function checkStatus(): State
    {
        $this->checkQuestionStatuses();
        return $this->matchStatus();
    }

    public function checkQuestionStatuses(): void
    {
        $this->resetQuestionStatuses();

        /** @var class-string<Question>[] $questions */
        $questions = $this->questions();
        $this->questionStatuses['total'] = count($questions);

        foreach ($questions as $questionClass) {
            $question = new $questionClass($this->form, $this);
            $questionStatus = $question->status();
            $this->questionStatuses[$questionStatus->name]++;
        }
    }

    public function hasError(): bool
    {
        return $this->questionStatuses[State::ThereIsAProblem->name] > 0;
    }

    public function hasNotBeenStarted(): bool
    {
        return $this->questionStatuses[State::NotYetStarted->name] === $this->questionStatuses['total'];
    }

    public function isComplete(): bool
    {
        return $this->questionStatuses[State::Completed->name] === $this->questionStatuses['total'];
    }

    public function isInProgress(): bool
    {
        return $this->questionStatuses[State::NotYetStarted->name] < $this->questionStatuses['total']
            && $this->questionStatuses[State::NotYetStarted->name] > 0;
    }

    protected function resetQuestionStatuses(): void
    {
        foreach ($this->questionStatuses as $key => $value) {
            $this->questionStatuses[$key] = 0;
        }
    }

    // CanRender
    public function actions(): array
    {
        return [
            'Back to tasks' => $this->form->tasks()->route(),
            'Exit' => $this->form->exitRoute(),
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

    // Actions
    public function show(): View
    {
        return $this
            ->with('colour', $this->statusColour())
            ->with('questions', $this->formatItems())
            ->with('status', $this->status());
    }
}
