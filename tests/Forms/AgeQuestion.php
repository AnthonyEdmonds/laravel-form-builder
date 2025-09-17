<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

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
        return [
            'age' => [
                'hint' => 'Provide their age in years',
                'label' => 'How old are they?',
                'optional' => true,
            ],
        ];
    }

    public function formRequest(): string
    {
        return AgeRequest::class;
    }
}
