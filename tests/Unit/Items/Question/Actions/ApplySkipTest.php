<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Foundation\Http\FormRequest;

class ApplySkipTest extends TestCase
{
    protected MyForm $form;

    protected FormRequest $formRequest;

    protected MyModel $model;

    protected Question $question;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');

        $this->formRequest = new FormRequest([
            'birthday' => '2025-11-01 15:29:00',
            'name' => 'Potato',
        ]);

        $this->question->applySkip($this->formRequest);
    }

    public function test(): void
    {
        $this->assertNull(
            $this->model->name,
        );

        $this->assertNull(
            $this->model->birthday,
        );
    }
}
