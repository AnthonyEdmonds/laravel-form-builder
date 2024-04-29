<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionTwo extends Question
{
    public const string KEY = 'question-one';

    public function name(): string
    {
        return 'question-one';
    }
}
