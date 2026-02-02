<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Fields;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\AgeQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\EmptyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ReadOnlyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasInputsTest extends TestCase
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
        $this->task = $this->form->tasks()->task(
            NextTask::key(),
        );
    }

    public function testTrue(): void
    {
        $this->question = $this->task->question(AgeQuestion::key());

        $this->assertTrue(
            $this->question->hasInputs(),
        );
    }

    public function testFalseWhenReadOnlyAndHidden(): void
    {
        $this->question = $this->task->question(ReadOnlyQuestion::key());

        $this->assertFalse(
            $this->question->hasInputs(),
        );
    }

    public function testFalseWhenNoFields(): void
    {
        $this->question = new EmptyQuestion($this->form, $this->task);

        $this->assertFalse(
            $this->question->hasInputs(),
        );
    }
}
