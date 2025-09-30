<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FormRouteTest extends TestCase
{
    public function testWithoutId(): void
    {
        $this->assertEquals(
            route('forms.new', MyForm::key()),
            MyModel::formRoute(),
        );
    }

    public function testWithId(): void
    {
        $this->assertEquals(
            route('forms.edit', [MyForm::key(), 1]),
            MyModel::formRoute(1),
        );
    }
}
