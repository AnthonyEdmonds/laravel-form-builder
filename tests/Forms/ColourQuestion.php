<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests\ColourRequest;
use ErrorException;

class ColourQuestion extends Question
{
    public static function key(): string
    {
        return 'colour-question';
    }

    public function fields(): array
    {
        return [
            Field::input('colour', 'What is your favourite colour?'),
        ];
    }

    public function formRequest(): string
    {
        return ColourRequest::class;
    }

    public function isValid(): bool
    {
        return $this->form->model->colour !== 'invalid'
            ? $this->form->model->colour
            : throw new ErrorException('Bad implementation');
    }
}
