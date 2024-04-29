<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;

class QuestionThree extends Question
{
    public const string KEY = 'question-three';

    public function name(): string
    {
        return 'question-three';
    }
}
