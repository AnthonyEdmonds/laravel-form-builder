<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
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
            Field::input('birthday', 'When is their birthday?', InputType::Date)
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
