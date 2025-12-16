<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests\AgeRequest;

/** @property MyForm $form */
class AgeQuestion extends Question
{
    public static function key(): string
    {
        return 'age-question';
    }

    public function fields(): array
    {
        return [
            Field::range('age', 'How old are they?', 1, 99, 1)
                ->setHint('Provide their age in years')
                ->optional(),
        ];
    }

    public function formRequest(): string
    {
        return AgeRequest::class;
    }

    public function isNotRequired(): bool
    {
        return $this->form->model->age_not_required === true;
    }
}
