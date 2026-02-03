<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Fields;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ColourQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\RecoverableTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FormatFieldsTest extends TestCase
{
    protected array $fields;

    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->name = 'Hello';
    }

    public function testNormalForm(): void
    {
        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
        $this->fields = $this->question->formatFields();

        $this->assertEquals(
            'Hello',
            $this->fields[0]->value,
        );

        $this->assertTrue(
            $this->fields[0]->isTitle,
        );
    }

    public function testHidesFields(): void
    {
        $this->form = new MyForm($this->model);

        $this->assertEmpty(
            $this->form->tasks()
                ->task('next-task')
                ->question('read-only')
                ->formatFields(),
        );
    }

    public function testRecoverableForm(): void
    {
        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task(RecoverableTask::key());
        $this->question = $this->task->question(ColourQuestion::key());

        $this->model->colour = 'not a colour';

        $this->fields = $this->question->formatFields();

        $this->assertEquals(
            null,
            $this->fields[0]->value,
            'If the value cannot be resolved it should be reset to null',
        );
    }
}
