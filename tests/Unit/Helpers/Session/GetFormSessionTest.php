<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Session;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormSessionExpired;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class GetFormSessionTest extends TestCase
{
    protected string $formKey;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formKey = MyForm::key();
        $this->model = new MyModel();
        $this->model->id = 1;
    }

    public function testGetsSession(): void
    {
        SessionHelper::setFormSession($this->formKey, $this->model);

        $this->assertTrue(
            $this->model->is(
                SessionHelper::getFormSession($this->formKey),
            ),
        );
    }

    public function testThrowsWhenNoSession(): void
    {
        $this->expectException(FormSessionExpired::class);
        $this->expectExceptionMessage('Your form session has expired; either edit a record or start fresh');

        SessionHelper::getFormSession($this->formKey);
    }
}
