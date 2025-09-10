<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Task;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\TaskController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected TaskController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new TaskController();
        $this->view = $this->controller->show(MyForm::key(), MyTask::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::task',
            $this->view->name(),
        );
    }
}
