<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Question;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\QuestionController;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class SaveTest extends TestCase
{
    protected QuestionController $controller;

    protected RedirectResponse $redirect;

    protected FormRequest $request;

    protected Form $form;

    protected function setUp(): void
    {
        parent::setUp();

        $model = $this->startFormSession();
        $this->form = new MyForm($model);

        request()->merge([
            'name' => 'Potato',
        ]);

        $this->request = new FormRequest([
            'name' => 'Potato',
        ]);

        $this->controller = new QuestionController();
        $this->redirect = $this->controller->save(
            $this->request,
            MyForm::key(),
            MyTask::key(),
            NameQuestion::key(),
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            $this->form->tasks()
                ->task('my-task')
                ->question('age-question')
                ->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
