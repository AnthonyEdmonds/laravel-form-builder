<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HideTitleTest extends TestCase
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

    public function testTrueWhenOneField(): void
    {
        $this->question = $this->task->question('name-question');

        $this->assertTrue(
            $this->question->hideTitle(),
        );
    }

    public function testFalseWhenMultipleFields(): void
    {
        $this->question = $this->task->question('birthday-question');

        $this->assertFalse(
            $this->question->hideTitle(),
        );
    }
}
