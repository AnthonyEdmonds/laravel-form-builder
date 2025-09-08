<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\QuestionNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasStates;
use Illuminate\Contracts\View\View;

abstract class Task extends Container implements UsesStates
{
    use HasStates;

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

    // Actions
    public function show(): View
    {
        // TODO
    }
}
