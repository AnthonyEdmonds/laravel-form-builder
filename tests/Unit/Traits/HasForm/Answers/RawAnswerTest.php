<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm\Answers;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RawAnswerTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
    }

    public function testAnswer(): void
    {
        $this->model->name = 'Peter';

        $this->assertEquals(
            'Peter',
            $this->model->rawAnswer('name'),
        );
    }

    public function testNull(): void
    {
        $this->model->name = null;

        $this->assertNull(
            $this->model->rawAnswer('name'),
        );
    }
}
