<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Task\UsesStates;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Carbon\Carbon;

class HasNotBeenStartedTest extends TestCase
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

    public function testTrueWhenBlank(): void
    {
        $this->assertTrue(
            $this->task->hasNotBeenStarted(),
        );
    }

    public function testFalseWhenAnyFilled(): void
    {
        $this->model->birthday = Carbon::now();

        $this->assertFalse(
            $this->task->hasNotBeenStarted(),
        );
    }
}
