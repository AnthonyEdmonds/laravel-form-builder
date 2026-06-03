<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm\Answers;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ClearAnswerTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->age = 1;
        $this->model->clearAnswer('age');
    }

    public function test(): void
    {
        $this->assertArrayNotHasKey(
            'age',
            $this->model->getAttributes(),
        );
    }
}
