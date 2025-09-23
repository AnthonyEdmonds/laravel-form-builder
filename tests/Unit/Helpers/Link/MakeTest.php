<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Link;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class MakeTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            Link::class,
            Link::make('My label', 'my-link'),
        );
    }
}
