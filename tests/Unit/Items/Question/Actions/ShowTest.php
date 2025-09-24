<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected Question $question;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
        $this->view = $this->question->show();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            NameQuestion::class,
            $this->view,
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->question->summarise(),
            $data['fields'],
        );

        $this->assertEquals(
            Link::make(
                $this->question->saveLabel(),
                $this->question->saveRoute(),
            ),
            $data['save'],
        );

        $this->assertEquals(
            Link::make(
                $this->question->skipLabel(),
                $this->question->skipRoute(),
            ),
            $data['skip'],
        );
    }
}
