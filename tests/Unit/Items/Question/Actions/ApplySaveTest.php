<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ReadOnlyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Foundation\Http\FormRequest;

class ApplySaveTest extends TestCase
{
    protected MyForm $form;

    protected FormRequest $formRequest;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);

        $this->formRequest = new FormRequest([
            'birthday' => '2025-11-01 15:29:00',
            'Hidden' => 'Nein',
            'name' => 'Potato',
            'Read only' => 'Ja',
        ]);
    }

    public function test(): void
    {
        $this->form
            ->tasks()
            ->task(MyTask::key())
            ->question(NameQuestion::key())
            ->applySave($this->formRequest);

        $this->assertEquals(
            'Potato',
            $this->model->name,
        );

        $this->assertNull(
            $this->model->birthday,
        );
    }

    public function testSkipsHidden(): void
    {
        $this->form
            ->tasks()
            ->task(NextTask::key())
            ->question(ReadOnlyQuestion::key())
            ->applySave($this->formRequest);

        $this->assertFalse(
            $this->model->hasAttribute('Read only'),
        );

        $this->assertFalse(
            $this->model->hasAttribute('Hidden'),
        );
    }
}
