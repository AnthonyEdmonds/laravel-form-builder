<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'summary',
            Summary::key(),
        );
    }
}
