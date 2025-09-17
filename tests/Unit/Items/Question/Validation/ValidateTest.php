<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Validation;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Validation\ValidationException;
use Throwable;

class ValidateTest extends TestCase
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

    public function testTrueWhenValid(): void
    {
        $this->expectNotToPerformAssertions();

        request()->merge([
            'name' => 'Potato',
        ]);

        try {
            $this->question->validate();
        } catch (Throwable $exception) {
            $this->fail('Validation failed unexpectedly');
        }
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(ValidationException::class);

        $this->model->name = null;
        $this->question->validate();
    }
}
