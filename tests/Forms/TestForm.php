<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\ForkOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionSix;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TaskOne;
use Illuminate\Database\Eloquent\Model;

class TestForm extends Form
{
    protected function quitFormRoute(): string
    {
        return route('quit');
    }

    public static function items(Model $model): array
    {
        return [
            QuestionOne::class,
            TaskOne::class,
            ForkOne::class,
            QuestionSix::class,
        ];
    }

    public static function key(): string
    {
        return 'my-form';
    }
}
