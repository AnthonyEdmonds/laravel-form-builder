<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;

class ForkTwo extends Fork
{
    public const string KEY = 'fork-two';

    protected array $forks = [
        'a' => [QuestionFive::class],
        'b' => [],
    ];

    public function name(): string
    {
        return 'fork-two';
    }

    protected function selectFork(): string
    {
        return 'a';
    }
}
