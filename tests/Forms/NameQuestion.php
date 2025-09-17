<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests\NameRequest;

class NameQuestion extends Question
{
    public static function key(): string
    {
        return 'name-question';
    }

    public function fields(): array
    {
        return [
            'name' => [
                'hint' => 'Provide their full name',
                'label' => 'What is their name?',
            ],
        ];
    }

    public function formRequest(): string
    {
        return NameRequest::class;
    }

    public function skipIsEnabled(): bool
    {
        return true;
    }
}
