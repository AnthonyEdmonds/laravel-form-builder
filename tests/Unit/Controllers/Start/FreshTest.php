<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Start;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\StartController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class FreshTest extends TestCase
{
    protected StartController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new StartController();
        $this->redirect = $this->controller->fresh(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.tasks.show', MyForm::key()),
            $this->redirect->getTargetUrl(),
        );
    }
}
