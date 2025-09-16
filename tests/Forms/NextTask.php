<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class NextTask extends Task
{
    public static function key(): string
    {
        return 'next-task';
    }

    public function label(): string
    {
        return 'Next task';
    }

    public function questions(): array
    {
        return [];
    }
}
