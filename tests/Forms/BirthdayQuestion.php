<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
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
            Field::date('birthday', 'When is their birthday?')
                ->setHint('Provide their date of birth'),
            Field::input('other', 'Another field?'),
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
