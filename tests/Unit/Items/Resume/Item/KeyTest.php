<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Resume\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'resume',
            Resume::key(),
        );
    }
}
