<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Resume;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\ResumeController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected ResumeController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new ResumeController();
        $this->view = $this->controller->show(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::resume',
            $this->view->name(),
        );
    }
}
