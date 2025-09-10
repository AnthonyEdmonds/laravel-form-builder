<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Question;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\QuestionController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected QuestionController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new QuestionController();
        $this->view = $this->controller->show(
            MyForm::key(),
            MyTask::key(),
            MyQuestion::key(),
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::question',
            $this->view->name(),
        );
    }
}
