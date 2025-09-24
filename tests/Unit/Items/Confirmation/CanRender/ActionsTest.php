<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Confirmation\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
{
    protected Confirmation $confirmation;

    protected Form $form;

    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);

        $this->confirmation = new Confirmation($this->form);
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'view' => Link::make(
                    $this->form->model->viewLabel(),
                    $this->form->model->viewRoute(),
                ),
                'restart' => Link::make(
                    $this->form->resume()->restartLabel(),
                    $this->form->newRoute(),
                ),
                'exit' => Link::make(
                    $this->form->exitLabel(),
                    $this->form->exitRoute(),
                ),
            ],
            $this->confirmation->actions(),
        );
    }
}
