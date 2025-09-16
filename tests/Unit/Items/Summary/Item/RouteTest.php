<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RouteTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Summary $summary;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->summary = $this->form->summary();
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.summary.show', $this->form->key),
            $this->summary->route(),
        );
    }
}
