<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CanChangeTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
    }

    public function testFalseWhenCantAccess(): void
    {
        $this->model->can_access = false;

        $this->assertFalse(
            $this->question->canChange(),
        );
    }

    public function testFalseWhenStatus(): void
    {
        $this->model->cannot_start = true;

        $this->assertFalse(
            $this->question->canChange(),
        );
    }

    public function testTrueOtherwise(): void
    {
        $this->assertTrue(
            $this->question->canChange(),
        );
    }
}
