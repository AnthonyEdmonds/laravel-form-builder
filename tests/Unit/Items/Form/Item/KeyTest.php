<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Item;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'my-form',
            MyForm::key(),
        );
    }
}
