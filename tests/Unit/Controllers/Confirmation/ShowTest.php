<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Confirmation;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\ConfirmationController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected ConfirmationController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new ConfirmationController();
        $this->view = $this->controller->show(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::confirmation',
            $this->view->name(),
        );
    }
}
