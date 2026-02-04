<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use ErrorException;
use Illuminate\Foundation\Http\FormRequest;

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
        return FormRequest::class;
    }

    public function isValid(): bool
    {
        return $this->form->model->colour === 'green'
            || throw new ErrorException('Bad implementation');
    }

    public function getRawAnswer(string $fieldName): mixed
    {
        return $this->form->model->colour === 'invalid'
            ? throw new ErrorException('Bad implementation')
            : $this->form->model->colour;
    }
}
