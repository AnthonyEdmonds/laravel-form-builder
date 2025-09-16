<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Confirmation\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TitleTest extends TestCase
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
            'My Model #1 has been submitted',
            $this->confirmation->title(),
        );
    }
}
