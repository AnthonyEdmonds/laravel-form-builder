<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm\Answers;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FormattedAnswerTest extends TestCase
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
            $this->model->formattedAnswer('name'),
        );
    }

    public function testNull(): void
    {
        $this->model->name = null;

        $this->assertEquals(
            $this->model->blankAnswer('name'),
            $this->model->formattedAnswer('name'),
        );
    }
}
