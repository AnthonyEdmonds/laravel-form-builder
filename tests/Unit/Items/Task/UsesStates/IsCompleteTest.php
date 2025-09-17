<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Carbon\Carbon;

class IsCompleteTest extends TestCase
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

    public function testTrueWhenComplete(): void
    {
        $this->model->age = 99;
        $this->model->birthday = Carbon::now();
        $this->model->name = 'Potato';

        $this->assertTrue(
            $this->task->isComplete(),
        );
    }

    public function testFalseWhenNot(): void
    {
        $this->assertFalse(
            $this->task->isComplete(),
        );
    }
}
