<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CheckQuestionStatusesTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();

        $this->form = new MyForm($this->model);
    }

    public function test(): void
    {
        $this->task = $this->form
            ->tasks()
            ->task(MyTask::key());

        $this->task->checkQuestionStatuses();
        $statuses = $this->task->getQuestionStatuses();

        $this->assertEquals(
            3,
            $statuses[State::NotYetStarted->name],
        );

        $this->assertEquals(
            3,
            $statuses['total'],
        );
    }
}
