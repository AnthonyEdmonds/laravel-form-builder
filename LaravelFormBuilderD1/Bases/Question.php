<?php

abstract class Question
{
    /** Whether to show the "other" button on the question page */
    public const bool CAN_SKIP = false;

    /** Whether the question should be shown again after saving */
    public const bool LOOPING = false;

    /** How to display the value of unanswered Questions */
    public const string NO_ANSWER_VALUE = 'Not given';

    /** Validate the given answers */
    public function validate(): void
    {
        request()->merge([
            'model' => $this->model,
        ]);

        app($this->formRequest());
    }
}
