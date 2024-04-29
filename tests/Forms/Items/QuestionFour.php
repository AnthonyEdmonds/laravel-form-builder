<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionFour extends Question
{
    public const string KEY = 'question-four';

    public function name(): string
    {
        return 'question-four';
    }
}
