<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Form;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class DraftTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
        $this->startFormSession();

        $this->controller = new FormController();
        $this->redirect = $this->controller->draft(MyForm::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            URL::to('/'),
            $this->redirect->getTargetUrl(),
        );
    }
}
