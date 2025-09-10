<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class MyTask extends Task
{
    public static function key(): string
    {
        return 'my-task';
    }

    public function label(): string
    {
        return 'My task';
    }

    public function questions(): array
    {
        return [
            MyQuestion::class,
        ];
    }
}
