<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Confirmation\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;

class ShowTest extends TestCase
{
    protected Confirmation $confirmation;

    protected Form $form;

    protected MyModel $model;

    protected ViewContract $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);

        $this->confirmation = new Confirmation($this->form);
        $this->view = $this->confirmation->show();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            View::class,
            $this->view,
        );

        $data = $this->view->getData();

        $this->assertTrue(
            $data['hideTitle'],
        );

        $this->assertTrue(
            $this->model->is($data['model']),
        );
    }
}
