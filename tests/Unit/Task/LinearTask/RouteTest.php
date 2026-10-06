<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Task\LinearTask;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RouteTest extends TestCase
{
    protected LinearForm $form;

    protected MyModel $model;

    protected LinearTask $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyLinearForm($this->model);
        $this->task = $this->form->tasks()
            ->task(LinearTask::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.task.questions.show', [
                MyLinearForm::key(),
                LinearTask::key(),
                NameQuestion::key(),
            ]),
            $this->task->route(),
        );
    }
}
