<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
        $this->view = $this->tasks->show();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            Tasks::class,
            $this->view,
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->tasks->formatItems(),
            $data['tasks'],
        );

        $this->assertEquals(
            Link::make(
                $this->form->draftLabel(),
                $this->form->draftRoute(),
            ),
            $data['draft'],
        );
    }
}
