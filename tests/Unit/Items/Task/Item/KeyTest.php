<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\Item;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'my-task',
            MyTask::key(),
        );
    }
}
