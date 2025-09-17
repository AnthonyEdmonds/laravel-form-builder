<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->view = $this->task->show();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            MyTask::class,
            $this->view,
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $data['colour'],
            $this->task->statusColour(),
        );

        $this->assertEquals(
            $data['questions'],
            $this->task->formatItems(),
        );

        $this->assertEquals(
            $data['status'],
            $this->task->status(),
        );
    }
}
