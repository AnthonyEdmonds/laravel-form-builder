<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Tasks;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\TasksController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected TasksController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new TasksController();
        $this->view = $this->controller->show(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::tasks',
            $this->view->name(),
        );
    }
}
