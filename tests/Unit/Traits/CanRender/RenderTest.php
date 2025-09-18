<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class RenderTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Question $question;

    protected Task $task;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
        $this->view = $this->question->render();
    }

    public function test(): void
    {
        $this->assertEquals(
            $this->question->blade(),
            $this->view->name(),
        );
    }
}
