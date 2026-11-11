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
            Field::radios(
                'colour',
                'What is your favourite colour?',
                [
                    'red' => 'Red',
                    'blue' => 'Blue',
                    'green' => 'Green',
                    'other' => [
                        'hint' => 'Select this option if you want to',
                        'label' => 'Pick this option',
                        'inputs' => [
                            Field::make('other', 'What is it called?')
                                ->setValue('potato'),
                        ],
                    ],
                ],
            ),
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
