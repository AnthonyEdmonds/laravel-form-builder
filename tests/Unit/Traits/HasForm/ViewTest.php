<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ViewTest extends TestCase
{
    protected MyModel $model;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->view = $this->model->view();
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::view',
            $this->view->name(),
        );

        $data = $this->view->getData();

        $this->assertEquals(
            Link::make(
                'Edit ' . $this->model->modelName(),
                $this->model->form()->editRoute(),
            ),
            $data['edit'],
        );

        $this->assertTrue(
            $this->model->is($data['model']),
        );

        $this->assertEquals(
            $this->model->form()->tasks()->summarise(),
            $data['summary'],
        );
    }
}
