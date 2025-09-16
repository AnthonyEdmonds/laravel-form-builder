<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Start\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Start;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ShowTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Start $start;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->start = $this->form->start();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            Start::class,
            $this->start->show(),
        );
    }
}
