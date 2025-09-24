<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Item;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\MissingLabel;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\EmptyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class LabelTest extends TestCase
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
    }

    public function testEmptyWhenNoFields(): void
    {
        $this->question = new EmptyQuestion($this->form, $this->task);

        $this->assertEquals(
            'Empty question',
            $this->question->label(),
        );
    }

    public function testThrowsWhenMultipleFields(): void
    {
        $this->expectException(MissingLabel::class);
        $this->expectExceptionMessage('You must provide a label when a question has multiple fields');

        $this->question = $this->task->question('birthday-question');
        $this->question->label();
    }

    public function testUsesFirstField(): void
    {
        $this->question = $this->task->question('name-question');

        $this->assertEquals(
            'What is their name?',
            $this->question->label(),
        );
    }
}
