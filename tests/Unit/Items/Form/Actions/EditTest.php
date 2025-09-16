<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class EditTest extends TestCase
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
    }

    public function testLoadsSession(): void
    {
        $this->startFormSession($this->model);

        $this->redirect = MyForm::edit($this->form->key, $this->model->id);

        $this->assertEquals(
            $this->redirect->getTargetUrl(),
            $this->form->resume()->route(),
        );
    }

    public function testLoadsDatabase(): void
    {
        $this->redirect = MyForm::edit($this->form->key, $this->model->id);

        $this->assertTrue(
            SessionHelper::modelHasSession($this->form->key, $this->model->id),
        );

        $this->assertEquals(
            $this->redirect->getTargetUrl(),
            $this->form->tasks()->route(),
        );
    }
}
