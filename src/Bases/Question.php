<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

abstract class Question extends Base
{
    /** Mutate the Model as required when storing the answers */
    abstract public function storeAnswers(FormRequest $request, UsesForm $model): void;

    // Setup
    public function __construct(public readonly Task $task)
    {
        //
    }

    // Skippable
    public function canSkip(): bool
    {
        return false;
    }

    /** Mutate the Model as required when skipping this Question */
    public function skipQuestion(FormRequest $request, UsesForm $model): void
    {
        //
    }

    // Actions
    public function save(FormRequest $request): RedirectResponse
    {
        $this->storeAnswers($request, $this->task->form->model);
    }

    public function show(): View
    {
        //
    }

    public function skip(FormRequest $request): RedirectResponse
    {
        $this->skipQuestion($request, $this->task->form->model);
    }
}
