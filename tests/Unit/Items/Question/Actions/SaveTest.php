<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class SaveTest extends TestCase
{
    protected MyForm $form;

    protected FormRequest $formRequest;

    protected MyModel $model;

    protected Question $question;

    protected RedirectResponse $redirect;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');

        request()->merge([
            'birthday' => '2025-11-01 15:29:00',
            'name' => 'Potato',
        ]);

        $this->formRequest = new FormRequest();
    }

    public function testRedirectsToNext(): void
    {
        $this->question = $this->task->question('name-question');
        $this->redirect = $this->question->save($this->formRequest);

        $this->assertEquals(
            $this->task->question('age-question')->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsToSummary(): void
    {
        $this->question = $this->task->question('name-question');
        $this->question->returnToSummary = true;
        $this->redirect = $this->question->save($this->formRequest);

        $this->assertEquals(
            $this->form->summary()->route() . "#{$this->task->key}",
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsToLoop(): void
    {
        $this->question = $this->task->question('birthday-question');
        $this->redirect = $this->question->save($this->formRequest);

        $this->assertEquals(
            $this->question->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
