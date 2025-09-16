<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ShowTest extends TestCase
{
    protected Form $form;

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
        $this->assertInstanceOf(
            Summary::class,
            $this->summary->show(),
        );
    }
}
