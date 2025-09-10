<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Form;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class SubmitTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
        $this->startFormSession();

        $this->controller = new FormController();
        $this->redirect = $this->controller->submit(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.confirmation.show', MyForm::key()),
            $this->redirect->getTargetUrl(),
        );
    }
}
