<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Setup;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class LoadTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            MyForm::class,
            Form::load('my-form'),
        );
    }
}
