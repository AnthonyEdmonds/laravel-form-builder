<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class BackLabelTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Summary $start;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->start = $this->form->summary();
    }

    public function test(): void
    {
        $this->assertEquals(
            $this->form->tasks()->backLabel(),
            $this->start->backLabel(),
        );
    }
}
