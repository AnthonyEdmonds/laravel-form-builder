<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items;

use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;
use Illuminate\Database\Eloquent\Model;

class ForkTwo extends Fork
{
    public static function items(Model $model): array
    {
        return [
            QuestionFive::class,
        ];
    }

    public static function key(): string
    {
        return 'fork-two';
    }

    public function name(): string
    {
        return 'fork-two';
    }
}
