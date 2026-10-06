<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;

/** @property MyModel $model */
class MyLinearForm extends LinearForm
{
    public static function key(): string
    {
        return 'linear-form';
    }

    public static function modelClass(): string
    {
        return MyModel::class;
    }

    public function questions(): array
    {
        return [
            LinearNameQuestion::class,
            LinearAgeQuestion::class,
        ];
    }
}
