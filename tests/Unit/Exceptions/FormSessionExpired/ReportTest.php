<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Exceptions\FormSessionExpired;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormSessionExpired;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ReportTest extends TestCase
{
    protected FormSessionExpired $exception;

    protected function setUp(): void
    {
        parent::setUp();

        $this->exception = new FormSessionExpired();
    }

    public function test(): void
    {
        $this->assertNull(
            $this->exception->report(),
        );
    }
}
