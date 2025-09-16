<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\DraftNotAllowed;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonDraftForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\NonDraftModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class DraftTest extends TestCase
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

        $this->form = new MyForm($this->model);
    }

    public function testThrowsWhenDraftDisabled(): void
    {
        $this->expectException(DraftNotAllowed::class);
        $this->expectExceptionMessage('This form does not support saving as a draft');

        $this->model = new NonDraftModel();
        $this->form = new NonDraftForm($this->model);
        $this->form->draft();
    }

    public function testRedirectsWhenDraftInvalid(): void
    {
        $this->startFormSession($this->model);

        $this->redirect = $this->form->draft();

        $this->assertDatabaseCount('my_models', 0);

        $this->assertTrue(
            Session::has('errors'),
        );

        $this->assertEquals(
            back()->getTargetUrl(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirects(): void
    {
        $this->model->draft_is_valid = true;
        $this->startFormSession($this->model);

        $this->redirect = $this->form->draft();

        $this->assertDatabaseCount('my_models', 1);

        $this->assertFalse(
            SessionHelper::formHasSession(MyForm::key()),
        );

        $this->assertEquals(
            $this->form->exit()->getTargetUrl(),
            $this->redirect->getTargetUrl(),
        );
    }
}
