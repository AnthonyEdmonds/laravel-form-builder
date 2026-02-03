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
        return ($this->form->model->colour === 'green') === true
            || throw new ErrorException('Bad implementation');
    }

    public function hasAnswer(string $fieldName): bool
    {
        dump($this->form->model->colour);
        return ($this->form->model->colour !== null) === true;
    }

    public function getFormattedAnswer(string $fieldKey): mixed
    {
        $colour = $this->form->model->colour;

        return ($colour === 'invalid') === true
            ? throw new ErrorException('Bad implementation')
            : $colour;
    }

    public function getRawAnswer(string $fieldName): mixed
    {
        $colour = $this->form->model->colour;

        return ($colour === 'not a colour') === true
            ? throw new ErrorException('Bad implementation')
            : $colour;
    }
}
