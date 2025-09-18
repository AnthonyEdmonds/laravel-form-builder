<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class MakeForFormTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            MyModel::class,
            MyModel::makeForForm(),
        );
    }
}
