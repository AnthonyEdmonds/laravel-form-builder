<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Task\LinearTask;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearAgeQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearNameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class NextItemTest extends TestCase
{
    protected LinearForm $form;

    protected MyModel $model;

    protected LinearTask $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyLinearForm($this->model);
        $this->task = $this->form->tasks()
            ->task(LinearTask::key());
    }

    public function testToNext(): void
    {
        $this->assertEquals(
            route('forms.task.questions.show', [
                MyLinearForm::key(),
                LinearTask::key(),
                LinearAgeQuestion::key(),
            ]),
            $this->task->nextItem(LinearNameQuestion::key())
                ->getTargetUrl(),
        );
    }

    public function testToSummary(): void
    {
        $this->assertEquals(
            route('forms.summary.show', [
                MyLinearForm::key(),
            ]),
            $this->task->nextItem(LinearAgeQuestion::key())
                ->getTargetUrl(),
        );
    }
}
