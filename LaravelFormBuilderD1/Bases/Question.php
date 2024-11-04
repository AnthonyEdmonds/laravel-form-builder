<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\Checkable;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class Question extends Item implements View
{
    use Checkable;

    /** Whether to show the "other" button on the question page */
    public const bool CAN_SKIP = false;

    /** Whether the question should be shown again after saving */
    public const bool LOOPING = false;

    /** How to display the value of unanswered Questions */
    public const string NO_ANSWER_VALUE = 'Not given';

    /** The method to use when saving this Question */
    public const string SAVE_METHOD = 'POST';

    /** The method to use when skipping this Question */
    public const string SKIP_METHOD = 'POST';

    // Input
    /** @return class-string<FormRequest> */
    abstract public function formRequest(): string;

    /** Handle applying the given answers to the Model */
    abstract public function save(Request $request): void;

    /** Handle skipping the current Question */
    public function skip(): void
    {
        //
    }

    /** Validate the given answers */
    public function validate(): void
    {
        request()->merge([
            'model' => $this->model,
        ]);

        app($this->formRequest());
    }

    // View
    /** Use a custom blade to provide more details */
    public function name(): string
    {
        return 'form-builder::items.question';
    }

    /** The title of the Question page */
    abstract public function title(): string;

    /** CSS classes for the save button */
    public function saveButtonStyles(): string
    {
        return '';
    }

    /** The label of the submit button */
    public function saveLabel(): string
    {
        // TODO Context
        // Could be last item, could be review, could be within task
        return 'Save and continue';
    }

    /** CSS classes for the skip button */
    public function skipButtonStyles(): string
    {
        return '';
    }

    /** The label of the skip button */
    public function skipLabel(): string
    {
        // TODO Context
        // Could be within task, which would be next, or last item in review, which could be back?
        return 'Skip and continue';
    }

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'can_skip' => static::CAN_SKIP,
                'looping' => static::LOOPING,
                'save_button_styles' => $this->saveButtonStyles(),
                'save_label' => $this->saveLabel(),
                'save_method' => static::SAVE_METHOD,
                'skip_button_styles' => $this->skipButtonStyles(),
                'skip_label' => $this->skipLabel(),
                'skip_method' => static::SKIP_METHOD,
                'title' => $this->title(),
            ],
        );
    }

    public function actionRoute(): ?string
    {
        return route('forms.items.save', [
            $this->form::key(),
            $this->model->currentPath,
        ]);
    }

    public function otherRoute(): ?string
    {
        return route('forms.items.skip', [
            $this->form::key(),
            $this->model->currentPath,
        ]);
    }
}
