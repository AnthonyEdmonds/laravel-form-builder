<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;

class ShowTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Summary $summary;

    protected ViewContract $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->summary = $this->form->summary();
        $this->view = $this->summary->show();
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            View::class,
            $this->view,
        );

        $data = $this->view->getData();

        $this->assertEquals(
            $this->form->tasks()->summarise(true, true),
            $data['summary'],
        );

        $this->assertEquals(
            Link::make(
                $this->form->submitLabel(),
                $this->form->submitRoute(),
            ),
            $data['submit'],
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
