<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionSix extends Question
{
    public function name(): string
    {
        return 'question-six';
    }

    public static function key(): string
    {
        return 'question-six';
    }
}
