<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class ExitTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->save();

        $this->form = new MyForm($this->model);
        $this->redirect = $this->form->exit();
    }

    public function test(): void
    {
        $this->assertEquals(
            route('/'),
            $this->redirect->getTargetUrl(),
        );
    }
}
