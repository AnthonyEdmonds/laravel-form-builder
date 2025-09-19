<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setup;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class MakeTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            Field::class,
            Field::make('my-name', 'My label'),
        );
    }
}
