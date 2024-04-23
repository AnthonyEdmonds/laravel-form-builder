<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class TestQuestionOne extends Question
{
    public function name()
    {
        return 'question-one-blade';
    }

    public static function key(): string
    {
        return 'question-one';
    }
}
