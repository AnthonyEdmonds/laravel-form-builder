<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SubmitIsValidTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->name = 'Bob';
        $this->model->age = 3;
        $this->model->birthday = '2025-12-12';
        $this->model->colour = 'green';
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->model->submitIsValid(),
        );
    }
}
