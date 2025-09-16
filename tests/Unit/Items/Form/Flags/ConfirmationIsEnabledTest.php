<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Flags;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ConfirmationIsEnabledTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->form->confirmationIsEnabled(),
        );
    }
}
