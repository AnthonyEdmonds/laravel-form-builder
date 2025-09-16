<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Start\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Start;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'start',
            Start::key(),
        );
    }
}
