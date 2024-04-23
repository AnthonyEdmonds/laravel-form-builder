<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;
use Illuminate\Database\Eloquent\Model;

class ForkOne extends Fork
{
    public static function items(Model $model): array
    {
        return [
            QuestionThree::class,
            TaskTwo::class,
        ];
    }

    public static function key(): string
    {
        return 'fork-one';
    }

    public function name(): string
    {
        return 'fork-one';
    }
}
