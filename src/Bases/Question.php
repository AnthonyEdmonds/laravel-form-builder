<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

abstract class Question extends Base
{
    // Setup
    public function __construct(public readonly Task $task)
    {
        //
    }

    // Show
    public function show(): View
    {
        return view('question.template')
            // Submit action, label, button type
            // Skip action, label, button type
            // Save and exit action, label, button type
            // Breadcrumb navigation
            ->with('title', $this->title())
            ->with('questions', $this->questions($this->task->form->model));
    }

    /** @returns QuestionClass[] An array of one or more QuestionClasses */
    abstract protected function questions(UsesForm $model): array;

    // Save
    /** Save this Question and move onto the next */
    public function save(FormRequest $request): RedirectResponse
    {
        $canSave = $this->canSave($request, $this->task->form->model);
        if ($canSave !== true) {
            // Throw exception with error
        }

        $this->applySave($request, $this->task->form->model);

        return $this->task->next();
    }

    /** @returns true|string True, or why this Question cannot be saved */
    protected function canSave(FormRequest $request, UsesForm $model): true|string
    {
        return true;
    }

    /** Mutate the Model as required when saving the answers to this Question */
    abstract protected function applySave(FormRequest $request, UsesForm $model): void;

    // Skip
    /** Skip this Question and move onto the next */
    public function skip(FormRequest $request): RedirectResponse
    {
        $canSkip = $this->canSkip($request, $this->task->form->model);
        if ($canSkip !== true) {
            // Throw exception with error
        }

        $this->applySkip($request, $this->task->form->model);

        return $this->task->next();
    }

    /** @return true|string True, or why this Question cannot be skipped */
    protected function canSkip(FormRequest $request, UsesForm $model): true|string
    {
        return 'You cannot skip this question';
    }

    /** Mutate the Model as required when skipping this Question */
    protected function applySkip(FormRequest $request, UsesForm $model): void
    {
        //
    }
}
