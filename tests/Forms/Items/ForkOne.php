<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;

class ForkOne extends Fork
{
    public const string KEY = 'fork-one';

    protected array $forks = [
        'a' => [
            QuestionThree::class,
            TaskTwo::class,
        ],
        'b' => [],
    ];

    public function name(): string
    {
        return 'fork-one';
    }

    protected function selectFork(): string
    {
        return 'a';
    }
}
