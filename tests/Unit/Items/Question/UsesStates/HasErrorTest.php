<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasErrorTest extends TestCase
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

    public function testTrueWhenInvalid(): void
    {
        $this->model->name = null;

        $this->assertTrue(
            $this->question->hasError(),
        );
    }

    public function testFalseWhenValid(): void
    {
        $this->model->name = 'Potato';

        $this->assertFalse(
            $this->question->hasError(),
        );
    }
}
