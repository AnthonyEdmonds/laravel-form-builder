<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Classes;

use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ConfirmationTest extends TestCase
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
        $this->assertInstanceOf(
            Confirmation::class,
            $this->form->confirmation(),
        );
    }
}
