<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonConfirmationForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SubmitTest extends TestCase
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
        $this->model->name = 'Bob';
        $this->model->age = 3;
        $this->model->birthday = '2025-12-12';
        $this->model->colour = 'green';

        $this->form = new MyForm($this->model);
    }

    public function testRedirectsWhenInvalid(): void
    {
        $this->model->name = null;
        $this->startFormSession($this->model);

        $this->redirect = $this->form->submit();

        $this->assertDatabaseCount('my_models', 0);

        $this->assertTrue(
            Session::has('errors'),
        );

        $this->assertEquals(
            back()->getTargetUrl(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsWhenConfirmationEnabled(): void
    {
        $this->redirect = $this->form->submit();

        $this->assertDatabaseCount('my_models', 1);

        $this->assertEquals(
            $this->form->confirmation()->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectsWhenConfirmationDisabled(): void
    {
        $this->form = new NonConfirmationForm($this->model);
        $this->redirect = $this->form->submit();

        $this->assertDatabaseCount('my_models', 1);

        $this->assertEquals(
            $this->model->viewRoute(),
            $this->redirect->getTargetUrl(),
        );
    }
}
