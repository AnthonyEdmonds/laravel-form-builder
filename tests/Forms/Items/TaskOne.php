<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class TaskOne extends Task
{
    public const string KEY = 'task-one';

    protected array $items = [
        QuestionTwo::class,
        ForkTwo::class,
    ];

    public function name(): string
    {
        return 'task-one';
    }
}
