<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Resume\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class BreadcrumbsTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Resume $resume;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->resume = $this->form->resume();
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                $this->form->label(),
                $this->resume->label() => $this->resume->route(),
            ],
            $this->resume->breadcrumbs(),
        );
    }
}
