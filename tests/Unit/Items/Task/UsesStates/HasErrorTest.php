<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasErrorTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
    }

    public function testTrueWhenErrors(): void
    {
        $this->model->age = 100;

        $this->assertTrue(
            $this->task->hasError(),
        );
    }

    public function testFalseWhenNoErrors(): void
    {
        $this->model->age = 99;

        $this->assertFalse(
            $this->task->hasError(),
        );
    }
}
