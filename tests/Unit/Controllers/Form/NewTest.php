<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Form;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class NewTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new FormController();
        $this->redirect = $this->controller->new(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.start.show', MyForm::key()),
            $this->redirect->getTargetUrl(),
        );
    }
}
