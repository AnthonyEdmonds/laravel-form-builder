<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Container;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\TaskNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TaskTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            MyTask::class,
            $this->tasks->task('my-task'),
        );
    }

    public function testThrowsWhenMissing(): void
    {
        $this->expectException(TaskNotFound::class);
        $this->expectExceptionMessage('No task has been registered on this form with the key "potato"');

        $this->tasks->task('potato');
    }
}
