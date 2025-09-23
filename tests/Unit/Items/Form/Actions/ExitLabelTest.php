<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Form\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ExitLabelTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
    }

    public function testWhenModelDirty(): void
    {
        $this->assertEquals(
            'Exit without saving',
            $this->form->exitLabel(),
        );
    }

    public function testWhenModelClean(): void
    {
        $this->model->save();

        $this->assertEquals(
            'Exit form',
            $this->form->exitLabel(),
        );
    }
}
