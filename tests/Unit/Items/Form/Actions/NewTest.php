<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonStartForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class NewTest extends TestCase
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
    }

    public function testRedirectsWhenSessionExists(): void
    {
        $this->form = new MyForm($this->model);
        SessionHelper::setFormSession($this->form->key, $this->model);
        $this->redirect = Form::new($this->form->key);

        $this->assertTrue(
            SessionHelper::formHasSession($this->form->key),
        );

        $this->assertEquals(
            $this->form->resume()->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsWhenModelExists(): void
    {
        $this->model->save();

        $this->form = new MyForm($this->model);
        SessionHelper::setFormSession($this->form->key, $this->model);
        $this->redirect = Form::new($this->form->key);

        $this->assertEquals(
            $this->form->start()->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsWhenStartEnabled(): void
    {
        $this->form = new MyForm($this->model);
        $this->redirect = Form::new($this->form->key);

        $this->assertTrue(
            SessionHelper::formHasSession($this->form->key),
        );

        $this->assertEquals(
            $this->form->start()->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsWhenStartDisabled(): void
    {
        $this->form = new NonStartForm($this->model);
        $this->redirect = Form::new($this->form->key);

        $this->assertEquals(
            $this->form->tasks()->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
