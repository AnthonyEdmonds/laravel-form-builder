<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\Form;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class EditTest extends TestCase
{
    protected FormController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $model = new MyModel();
        $model->save();

        $this->controller = new FormController();
        $this->redirect = $this->controller->edit(MyForm::key(), $model->id);
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.tasks.show', MyForm::key()),
            $this->redirect->getTargetUrl(),
        );
    }
}
