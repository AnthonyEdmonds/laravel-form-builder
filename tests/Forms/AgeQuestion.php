<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests\AgeRequest;

class AgeQuestion extends Question
{
    public static function key(): string
    {
        return 'age-question';
    }

    public function fields(): array
    {
        return [ // TODO Update Question fields to not use keyed array
            Field::range('age', 'How old are they?', 1, 99, 1)
                ->setHint('Provide their age in years')
                ->setOptional(true),
        ];
    }

    public function formRequest(): string
    {
        return AgeRequest::class;
    }
}
