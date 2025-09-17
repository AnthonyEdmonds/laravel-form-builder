<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Foundation\Http\FormRequest;

class EmptyQuestion extends Question
{
    public static function key(): string
    {
        return 'empty-question';
    }

    public function fields(): array
    {
        return [];
    }

    public function formRequest(): string
    {
        return FormRequest::class;
    }
}
