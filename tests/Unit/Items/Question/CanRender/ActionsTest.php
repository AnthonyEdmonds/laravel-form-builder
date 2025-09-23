<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
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

    public function test(): void
    {
        $this->assertEquals(
            [
                'back' => Link::make(
                    $this->question->backLabel(),
                    $this->task->previousItem($this->question->key)->getTargetUrl(),
                ),
                'task' => Link::make(
                    $this->task->backLabel(),
                    $this->task->route(),
                ),
                'exit' => Link::make(
                    $this->form->backLabel(),
                    $this->form->exitRoute(),
                ),
            ],
            $this->question->actions(),
        );
    }
}
