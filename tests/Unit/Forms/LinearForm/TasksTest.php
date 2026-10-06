<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Forms\LinearForm;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tasks\LinearTasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TasksTest extends TestCase
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
            $this->form->questions(),
            $this->tasks->questions,
        );
    }
}
