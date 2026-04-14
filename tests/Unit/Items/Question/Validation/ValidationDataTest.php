<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Validation;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\BirthdayQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Carbon\Carbon;

class ValidationDataTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->name = 'Potato';
        $this->model->birthday = Carbon::create(2026, 4, 14);

        $this->form = new MyForm($this->model);
    }

    public function test(): void
    {
        $this->question = $this->form
            ->tasks()
            ->task(MyTask::key())
            ->question(NameQuestion::key());

        $this->assertEquals(
            [
                'model' => $this->model,
                'name' => 'Potato',
            ],
            $this->question->validationData(),
        );
    }

    public function testAddsDateParts(): void
    {
        $this->question = $this->form
            ->tasks()
            ->task(MyTask::key())
            ->question(BirthdayQuestion::key());

        $this->assertEquals(
            [
                'model' => $this->model,
                'birthday' => $this->model->birthday,
                'birthday-day' => $this->model->birthday->day,
                'birthday-month' => $this->model->birthday->month,
                'birthday-year' => $this->model->birthday->year,
                'other' => null,
            ],
            $this->question->validationData(),
        );
    }
}
