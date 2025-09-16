<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'tasks',
            Tasks::key(),
        );
    }
}
