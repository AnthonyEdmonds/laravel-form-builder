<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Foundation\Http\FormRequest;

class MyQuestion extends Question
{
    public static function key(): string
    {
        return 'my-question';
    }

    public function fields(): array
    {
        return [];
    }

    public function formRequest(): FormRequest
    {
        return new FormRequest();
    }
}
