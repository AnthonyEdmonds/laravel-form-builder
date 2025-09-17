<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests\BirthdayRequest;

class BirthdayQuestion extends Question
{
    public static function key(): string
    {
        return 'birthday-question';
    }

    public function fields(): array
    {
        return [
            'birthday' => [
                'hint' => 'Provide their date of birth',
                'label' => 'When is their birthday?',
                'optional' => false,
            ],
        ];
    }

    public function formRequest(): string
    {
        return BirthdayRequest::class;
    }

    public function loopingIsEnabled(): bool
    {
        return true;
    }
}
