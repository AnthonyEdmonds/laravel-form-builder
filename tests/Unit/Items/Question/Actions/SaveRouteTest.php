<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SaveRouteTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Question $question;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.task.questions.save', [
                $this->form->key,
                $this->task->key,
                $this->question->key,
            ]),
            $this->question->saveRoute(),
        );
    }

    public function testReturnToSummary(): void
    {
        $this->question->returnToSummary = true;

        $this->assertEquals(
            route('forms.task.questions.save', [
                $this->form->key,
                $this->task->key,
                $this->question->key,
            ]) . '?return=summary',
            $this->question->saveRoute(),
        );
    }
}
