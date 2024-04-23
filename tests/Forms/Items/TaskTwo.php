<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use Illuminate\Database\Eloquent\Model;

class TaskTwo extends Task
{
    public static function items(Model $model): array
    {
        return [
            QuestionFour::class,
        ];
    }

    public static function key(): string
    {
        return 'task-two';
    }

    public function name(): string
    {
        return 'task-two';
    }
}
