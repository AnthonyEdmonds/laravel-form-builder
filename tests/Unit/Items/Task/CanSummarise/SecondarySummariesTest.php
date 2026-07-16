<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\UploadFilesQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SecondarySummariesTest extends TestCase
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
        $this->task = $this->form
            ->tasks()
            ->task(MyTask::key());
    }

    public function test(): void
    {
        $question = $this->task->question(UploadFilesQuestion::key());

        $this->assertEquals(
            [
                [
                    'actions' => [],
                    'group' => $this->task->group,
                    'id' => MyTask::key() . '-' . UploadFilesQuestion::key(),
                    'list' => $question->secondarySummaries(),
                    'title' => $question->label(),
                ],
            ],
            $this->task->secondarySummaries(),
        );
    }
}
