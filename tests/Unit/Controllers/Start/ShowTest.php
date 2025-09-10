<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Start;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\StartController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected StartController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new StartController();
        $this->view = $this->controller->show(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::start',
            $this->view->name(),
        );
    }
}
