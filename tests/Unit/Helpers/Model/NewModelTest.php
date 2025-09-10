<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Model;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\ModelHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class NewModelTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            MyModel::class,
            ModelHelper::newModel(MyForm::class),
        );
    }
}
