<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Tasks\LinearTasks;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tasks\LinearTasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearNameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RouteTest extends TestCase
{
    protected LinearForm $form;

    protected MyModel $model;

    protected LinearTasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyLinearForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.task.questions.show', [
                MyLinearForm::key(),
                LinearTask::key(),
                LinearNameQuestion::key(),
            ]),
            $this->tasks->route(),
        );
    }
}
