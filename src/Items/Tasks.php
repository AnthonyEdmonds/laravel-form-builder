<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\TaskNotFound;
use Illuminate\Contracts\View\View;

abstract class Tasks extends Container
{
    // Setup
    final public function __construct(
        public Form $form,
    ) {
        parent::__construct();
    }

    // Item
    public function route(): string
    {
        return route('forms.tasks.show', [
            $this->form->key,
        ]);
    }

    // Container
    /** @returns class-string<Task>[] */
    abstract public function tasks(): array;

    /** @returns class-string<Task>[] */
    public function items(): array
    {
        return $this->tasks();
    }

    /** @param class-string<Task> $itemClass */
    public function makeItem(string $itemClass): Task
    {
        return new $itemClass($this->form);
    }

    public function task(string $taskKey): Task
    {
        /** @var ?Task $task */
        $task = $this->findItem($taskKey);

        return $task
            ?? throw new TaskNotFound("No task has been registered on this form with the key \"$taskKey\"");
    }

    // Actions
    public function show(): View
    {
        // TODO
    }
}
