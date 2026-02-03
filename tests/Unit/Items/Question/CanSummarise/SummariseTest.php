<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\CanSummarise;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ColourQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\RecoverableTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SummariseTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
    }

    public function testNormalForm(): void
    {
        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');

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
                    'label' => 'Name',
                    'status' => $this->question->status()->value,
                    'value' => $this->question->getFormattedAnswer('name'),
                ],
            ],
            $this->question->summarise(true, true),
        );
    }

    public function testSummarisesHiddenFields(): void
    {
        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('next-task');
        $this->question = $this->task->question('read-only');

        $this->assertEquals(
            [
                'Read only' => [
                    'label' => 'Read only',
                    'value' => 'No changing',
                ],
            ],
            $this->question->summarise(true, true),
        );
    }

    public function testRecoverableForm(): void
    {
        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task(RecoverableTask::key());
        $this->question = $this->task->question(ColourQuestion::key());

        $this->model->colour = 'invalid';

        $this->assertEquals(
            [
                'Colour' => [
                    'label' => 'Colour',
                    'value' => 'Not provided',
                ],
            ],
            $this->question->summarise(false, false),
        );
    }
}
