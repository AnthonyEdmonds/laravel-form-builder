<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\Item;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\AccessNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CheckAccessTest extends TestCase
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

    public function testThrowsWhenNotEnabled(): void
    {
        $this->expectException(AccessNotAllowed::class);
        $this->expectExceptionMessage('You are not allowed to access this task at the moment');

        $this->model->not_required = true;

        $this->task->checkAccess();
    }

    public function testAllowsOtherwise(): void
    {
        $this->assertInstanceOf(
            MyTask::class,
            $this->task->checkAccess(),
        );
    }
}
