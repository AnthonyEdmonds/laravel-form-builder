<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionTwo extends Question
{
    public function name(): string
    {
        return 'question-one';
    }

    public static function key(): string
    {
        return 'question-one';
    }
}
