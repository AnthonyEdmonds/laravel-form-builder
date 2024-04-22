<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasItems;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\TestForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\TestUser;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class IndexItemsTest extends TestCase
{
    public function test(): void
    {
        $form = new TestForm(new TestUser());
        dd($form::index());
    }
}
