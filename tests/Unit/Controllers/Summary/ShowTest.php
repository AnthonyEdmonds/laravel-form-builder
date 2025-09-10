<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Summary;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\SummaryController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected SummaryController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new SummaryController();
        $this->view = $this->controller->show(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::summary',
            $this->view->name(),
        );
    }
}
