<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

abstract class Question extends Item implements ItemInterface
{
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
