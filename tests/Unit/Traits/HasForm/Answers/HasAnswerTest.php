<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm\Answers;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasAnswerTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
    }

    public function testTrueWhenSet(): void
    {
        $this->model->name = 'Peter';

        $this->assertTrue(
            $this->model->hasAnswer('name'),
        );
    }

    public function testFalseWhenNot(): void
    {
        $this->assertFalse(
            $this->model->hasAnswer('name'),
        );
    }
}
