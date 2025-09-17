<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CheckStatusTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->name = 'Test';

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
    }

    public function test(): void
    {
        $this->assertEquals(
            State::InProgress,
            $this->task->checkStatus(),
        );
    }
}
