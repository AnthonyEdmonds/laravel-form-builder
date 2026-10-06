<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Task\LinearTask;

use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'linear',
            LinearTask::key(),
        );
    }
}
