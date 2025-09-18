<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class FormClassTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            MyForm::class,
            MyModel::formClass(),
        );
    }

    public function testThrowsWhenMissing(): void
    {
        $this->expectException(FormNotFound::class);
        $this->expectExceptionMessage('No form has been registered for the "MyModel" model');

        Config::set('form-builder.forms', []);
        MyModel::formClass();
    }
}
