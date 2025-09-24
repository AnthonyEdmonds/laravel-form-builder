<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SummariseTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
        $this->task = $this->tasks->task('my-task');
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'title' => $this->task->label(),
                'list' => [
                    $this->task->question('name-question')->summarise(),
                    $this->task->question('age-question')->summarise(),
                    $this->task->question('birthday-question')->summarise(),
                ],
                'actions' => [
                    $this->task->changeLabel() => $this->task->route(),
                ],
            ],
            $this->task->summarise(),
        );
    }
}
