<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Fields;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HasAnswersTest extends TestCase
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
    }

    public function testSkipsWhenOptional(): void
    {
        $this->question = $this->task->question('age-question');
        $this->model->age = null;

        $this->assertTrue(
            $this->question->hasAnswers(),
        );
    }

    public function testFalseWhenNull(): void
    {
        $this->question = $this->task->question('name-question');
        $this->model->name = null;

        $this->assertFalse(
            $this->question->hasAnswers(),
        );
    }

    public function testTrueWhenAnswered(): void
    {
        $this->question = $this->task->question('name-question');
        $this->model->name = 'Potato';

        $this->assertTrue(
            $this->question->hasAnswers(),
        );
    }
}
