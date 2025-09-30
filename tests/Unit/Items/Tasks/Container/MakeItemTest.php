<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Container;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class MakeItemTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function testNullGroup(): void
    {
        $this->task = $this->tasks->makeItem(MyTask::class);

        $this->assertNull(
            $this->task->group,
        );
    }

    public function testNamedGroup(): void
    {
        $this->task = $this->tasks->makeItem(NextTask::class);

        $this->assertEquals(
            'The next task',
            $this->task->group,
        );
    }
}
