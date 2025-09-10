<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Session;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ModelHasSessionTest extends TestCase
{
    protected string $formKey;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formKey = MyForm::key();
        $this->model = new MyModel();
        $this->model->id = 1;

        SessionHelper::setFormSession($this->formKey, $this->model);
    }

    public function testFalseWhenNoSession(): void
    {
        SessionHelper::clearFormSession($this->formKey);

        $this->assertFalse(
            SessionHelper::modelHasSession($this->formKey, $this->model->id),
        );
    }

    public function testFalseWhenMismatch(): void
    {
        $this->assertFalse(
            SessionHelper::modelHasSession($this->formKey, '2'),
        );
    }

    public function testTrue(): void
    {
        $this->assertTrue(
            SessionHelper::modelHasSession($this->formKey, $this->model->id),
        );
    }
}
