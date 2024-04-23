<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionThree extends Question
{
    public function name(): string
    {
        return 'question-three';
    }

    public static function key(): string
    {
        return 'question-three';
    }
}
