<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\RecoverableTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SummariseTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected array $summaries;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();

        $this->summaries = $this->tasks->summarise(true, true);
    }

    public function test(): void
    {
        $this->assertCount(4, $this->summaries);

        $this->assertEquals(
            $this->tasks->task(MyTask::key())->summarise(true, true),
            $this->summaries[0],
        );

        $this->assertEquals(
            $this->tasks->task(MyTask::key())->secondarySummaries()[0],
            $this->summaries[1],
        );

        $this->assertEquals(
            $this->tasks->task(NextTask::key())->summarise(true, true),
            $this->summaries[2],
        );

        $this->assertEquals(
            $this->tasks->task(RecoverableTask::key())->summarise(true, true),
            $this->summaries[3],
        );
    }
}
