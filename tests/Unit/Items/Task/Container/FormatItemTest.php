<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\Container;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FormatItemTest extends TestCase
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
        $question = $this->task->question('my-question');

        $this->assertEquals(
            [
                'fields' => $question->formatFields(),
                'link' => $question->route(),
            ],
            $this->task->formatItem($question),
        );
    }
}
