<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Item;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'name-question',
            NameQuestion::key(),
        );
    }
}
