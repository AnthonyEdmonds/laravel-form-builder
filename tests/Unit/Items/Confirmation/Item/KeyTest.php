<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Confirmation\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'confirmation',
            Confirmation::key(),
        );
    }
}
