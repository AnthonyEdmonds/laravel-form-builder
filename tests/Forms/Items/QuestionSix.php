<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionSix extends Question
{
    public const string KEY = 'question-six';

    public function name(): string
    {
        return 'question-six';
    }
}
