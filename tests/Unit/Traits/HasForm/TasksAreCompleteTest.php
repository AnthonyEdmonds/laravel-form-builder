<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TasksAreCompleteTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
    }

    public function testStringWhenTasksError(): void
    {
        $this->assertEquals(
            'The following tasks need to be completed: My task, Next task',
            $this->model->tasksAreComplete(),
        );
    }

    public function testTrueOtherwise(): void
    {
        $this->model->name = 'Bob';
        $this->model->age = 3;
        $this->model->birthday = '2025-12-12';

        $this->assertTrue(
            $this->model->tasksAreComplete(),
        );
    }
}
