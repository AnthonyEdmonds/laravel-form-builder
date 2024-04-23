<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionFour extends Question
{
    public function name(): string
    {
        return 'question-four';
    }

    public static function key(): string
    {
        return 'question-four';
    }
}
