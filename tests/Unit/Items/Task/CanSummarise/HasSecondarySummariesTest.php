<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasSecondarySummariesTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
    }

    public function testTrueWhen(): void
    {
        $this->task = $this->form
            ->tasks()
            ->task(MyTask::key());

        $this->assertTrue(
            $this->task->hasSecondarySummaries(),
        );
    }

    public function testFalseWhen(): void
    {
        $this->task = $this->form
            ->tasks()
            ->task(NextTask::key());

        $this->assertFalse(
            $this->task->hasSecondarySummaries(),
        );
    }
}
