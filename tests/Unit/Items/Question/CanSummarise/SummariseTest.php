<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SummariseTest extends TestCase
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
                'Name' => [
                    'actions' => [
                        'change' => [
                            'label' => $this->question->changeLabel(),
                            'url' => $this->question->route() . '?return=summary',
                        ],
                    ],
                    'colour' => $this->question->statusColour()->value,
                    'status' => $this->question->status()->value,
                    'value' => $this->question->getFormattedAnswer('name'),
                ],
            ],
            $this->question->summarise(),
        );
    }
}
