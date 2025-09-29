<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Item;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class CanAccessTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();

        $this->form = new MyForm($this->model);
    }

    public function testTrueWhenFine(): void
    {
        $this->model->can_access = true;

        $this->assertTrue(
            $this->form->canAccess(),
        );
    }

    public function testFalseWhenNot(): void
    {
        $this->model->can_access = false;

        $this->assertFalse(
            $this->form->canAccess(),
        );
    }
}
