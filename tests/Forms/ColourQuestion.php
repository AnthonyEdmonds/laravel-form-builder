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

    /**
     * @throws ErrorException Throws to emulate a bad implementation in user code
     */
    public function isValid(): bool
    {
        throw new ErrorException('Bad implementation');
    }

    public function hasAnswer(string $fieldName): bool
    {
        return true;
    }

    /**
     * @throws ErrorException Throws to emulate a bad implementation in user code
     */
    public function getFormattedAnswer(string $fieldKey): mixed
    {
        $colour = $this->form->model->colour;

        return $colour === 'mystery colour'
            ? throw new ErrorException('Bad implementation')
            : $colour;
    }

    /**
     * @throws ErrorException Throws to emulate a bad implementation in user code
     */
    public function getRawAnswer(string $fieldName): mixed
    {
        $colour = $this->form->model->colour;

        return $colour === 'not a colour'
            ? throw new ErrorException('Bad implementation')
            : $colour;
    }
}
