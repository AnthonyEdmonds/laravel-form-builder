<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\Container;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\QuestionNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class QuestionTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            NameQuestion::class,
            $this->task->question('name-question'),
        );
    }

    public function testThrowsWhenMissing(): void
    {
        $this->expectException(QuestionNotFound::class);
        $this->expectExceptionMessage('No question has been registered on this form task with the key "potato"');

        $this->task->question('potato');
    }
}
