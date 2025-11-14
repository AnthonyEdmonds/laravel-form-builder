<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Foundation\Http\FormRequest;

class ReadOnlyQuestion extends Question
{
    public static function key(): string
    {
        return 'read-only';
    }

    public function fields(): array
    {
        return [
            Field::readonly('Read only', 'No changing'),
            Field::hidden('Hidden', 'No viewing'),
        ];
    }

    public function formRequest(): string
    {
        return FormRequest::class;
    }
}
