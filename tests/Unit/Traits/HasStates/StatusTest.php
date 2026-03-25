<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasStates;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ColourQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\RecoverableTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class StatusTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Question $question;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->colour = 'blue';

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task(RecoverableTask::key());
        $this->question = $this->task->question(ColourQuestion::key());
    }

    public function testHandlesException(): void
    {
        $this->model->colour = 'invalid';

        $this->assertEquals(
            State::ThereIsAProblem,
            $this->question->status(),
        );
    }

    public function testGetsStatus(): void
    {
        $this->assertEquals(
            State::Completed,
            $this->question->status(),
        );
    }
}
