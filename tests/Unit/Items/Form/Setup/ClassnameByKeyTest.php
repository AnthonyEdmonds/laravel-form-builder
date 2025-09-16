<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Setup;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ClassnameByKeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            MyForm::class,
            Form::classnameByKey('my-form'),
        );
    }

    public function testThrowsWhenMissing(): void
    {
        $this->expectException(FormNotFound::class);
        $this->expectExceptionMessage('No form has been registered with the key "potato"');

        Form::classnameByKey('potato');
    }
}
