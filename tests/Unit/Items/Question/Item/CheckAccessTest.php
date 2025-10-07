<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Item;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\AccessNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CheckAccessTest extends TestCase
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

    public function testThrowsWhenNotEnabled(): void
    {
        $this->expectException(AccessNotAllowed::class);
        $this->expectExceptionMessage('You are not allowed to answer this question at the moment');

        $this->model->not_required = true;

        $this->question->checkAccess();
    }

    public function testAllowsOtherwise(): void
    {
        $this->assertInstanceOf(
            NameQuestion::class,
            $this->question->checkAccess(),
        );
    }
}
