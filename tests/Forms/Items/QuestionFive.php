<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionFive extends Question
{
    public function name(): string
    {
        return 'question-five';
    }

    public static function key(): string
    {
        return 'question-five';
    }
}
