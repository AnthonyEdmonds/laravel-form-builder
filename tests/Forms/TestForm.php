<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TestQuestionOne;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Item
 * @mixin Container
 */
class TestForm extends Form
{
    protected function checkClass(): string
    {
        // TODO: Implement checkClass() method.
    }

    protected function resumeClass(): string
    {
        // TODO: Implement resumeClass() method.
    }

    public static function items(Model $model): array
    {
        return [
            TestQuestionOne::class,
        ];
    }

    public static function key(): string
    {
        return 'my-form';
    }

    public function name()
    {
        return '';
    }
}
