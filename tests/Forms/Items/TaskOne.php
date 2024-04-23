<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use Illuminate\Database\Eloquent\Model;

class TaskOne extends Task
{
    public static function items(Model $model): array
    {
        return [
            QuestionTwo::class,
            ForkTwo::class,
        ];
    }

    public static function key(): string
    {
        return 'task-one';
    }

    public function name(): string
    {
        return 'task-one';
    }
}
