<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Models;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ModelClassTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            MyModel::class,
            MyForm::modelClass(),
        );
    }
}
