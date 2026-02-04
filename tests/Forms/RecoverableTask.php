<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class RecoverableTask extends Task
{
    public static function key(): string
    {
        return 'recoverable-task';
    }

    public function label(): string
    {
        return 'Recoverable task';
    }

    public function questions(): array
    {
        return [
            ColourQuestion::class,
        ];
    }
}
