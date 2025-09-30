<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Container;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TasksTest extends TestCase
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
        $this->assertEquals(
            [
                MyTask::class,
                'The next task' => [
                    NextTask::class,
                ],
            ],
            $this->tasks->tasks(),
        );
    }
}
