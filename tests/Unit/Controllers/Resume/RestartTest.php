<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Resume;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\ResumeController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class RestartTest extends TestCase
{
    protected ResumeController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startFormSession();

        $this->controller = new ResumeController();
        $this->redirect = $this->controller->restart(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.start.show', MyForm::key()),
            $this->redirect->getTargetUrl(),
        );
    }
}
