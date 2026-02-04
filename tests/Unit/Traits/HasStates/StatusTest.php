<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasStates;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ColourQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
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
    }

    public function test(): void
    {
        $this->task = $this->form->tasks()->task(MyTask::key());
        $this->question = $this->task->question(NameQuestion::key());

        $this->assertEquals(
            State::NotYetStarted,
            $this->question->status(),
        );

        $this->task = $this->form->tasks()->task(RecoverableTask::key());
        $this->question = $this->task->question(ColourQuestion::key());

        $this->assertEquals(
            State::ThereIsAProblem,
            $this->question->status(),
        );
    }
}
