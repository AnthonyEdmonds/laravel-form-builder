<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class NewFormTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            MyForm::class,
            MyModel::newForm(),
        );
    }
}
