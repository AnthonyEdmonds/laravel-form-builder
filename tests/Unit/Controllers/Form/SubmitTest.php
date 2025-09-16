<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Form;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class SubmitTest extends TestCase
{
    protected FormController $controller;

    protected MyModel $model;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->submit_is_valid = true;
        $this->startFormSession($this->model);

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
