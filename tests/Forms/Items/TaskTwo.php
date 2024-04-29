<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class TaskTwo extends Task
{
    public const string KEY = 'task-two';

    protected array $items = [
        QuestionFour::class,
    ];

    public function name(): string
    {
        return 'task-two';
    }
}
