<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasStates;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

abstract class Question extends Item implements ItemInterface, UsesStates
{
    use HasStates;

    // Setup
    final public function __construct(
        public Form $form,
        public Task $task,
    ) {
        parent::__construct();
    }

    // Item
    public function route(): string
    {
        return route('forms.task.question.show', [
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
        return $this->hasAnswer() === true;
    }

    public function hasNotBeenStarted(): bool
    {
        return $this->hasAnswer() === false;
    }

    // Answers
    public function answer(): ?string
    {
        $property = $this->answerProperty();

        return $this->form->model->$property !== null
            ? (string) $this->form->model->$property
            : null;
    }

    public function answerProperty(): string
    {
        return static::key();
    }

    public function blankAnswerLabel(): string
    {
        return 'Not given';
    }

    public function hasAnswer(): bool
    {
        return $this->answer() !== null;
    }

    public function formattedAnswer(): string
    {
        return $this->answer() ?? $this->blankAnswerLabel();
    }

    public function isValid(): bool
    {
        // TODO
    }

    public function validate(): void
    {
        // TODO
    }

    // Actions
    public function save(): RedirectResponse
    {
        // TODO
    }

    public function show(): View
    {
        // TODO
    }

    public function skip(): RedirectResponse
    {
        // TODO
    }
}
