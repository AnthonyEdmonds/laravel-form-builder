<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\CanFormat;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FormatTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->task->group = 'Potato';
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'colour' => $this->task->statusColour()->value,
                'group' => $this->task->group,
                'hint' => $this->task->description(),
                'id' => $this->task->key,
                'label' => $this->task->label(),
                'status' => $this->task->status()->value,
                'url' => $this->task->route(),
            ],
            $this->task->format(),
        );
    }

    public function testWhenDisabled(): void
    {
        $this->model->cannot_start = true;

        $this->assertEquals(
            [
                'colour' => $this->task->statusColour()->value,
                'group' => $this->task->group,
                'hint' => $this->task->description(),
                'id' => $this->task->key,
                'label' => $this->task->label(),
                'status' => $this->task->status()->value,
                'url' => null,
            ],
            $this->task->format(),
        );
    }
}
