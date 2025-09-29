<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CanChangeTest extends TestCase
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
        $this->task = $this->form->tasks()->task('my-task');
    }

    public function testFalseWhenCantAccess(): void
    {
        $this->model->can_access = false;

        $this->assertFalse(
            $this->task->canChange(),
        );
    }

    public function testFalseWhenStatus(): void
    {
        $this->model->cannot_start = true;

        $this->assertFalse(
            $this->task->canChange(),
        );
    }

    public function testTrueOtherwise(): void
    {
        $this->assertTrue(
            $this->task->canChange(),
        );
    }
}
