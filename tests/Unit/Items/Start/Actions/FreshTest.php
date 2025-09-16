<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Start\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Start;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class FreshTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Start $start;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->start = $this->form->start();

        $this->redirect = $this->start->fresh();
    }

    public function test(): void
    {
        $this->assertTrue(
            SessionHelper::formHasSession($this->form->key),
        );

        $this->assertEquals(
            $this->form->tasks()->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
