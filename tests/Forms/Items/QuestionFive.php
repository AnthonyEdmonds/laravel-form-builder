<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionFive extends Question
{
    public const string KEY = 'question-five';

    public function name(): string
    {
        return 'question-five';
    }
}
