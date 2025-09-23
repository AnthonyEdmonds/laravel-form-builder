<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Summary $summary;

    protected Tasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->summary = $this->form->summary();
        $this->tasks = $this->form->tasks();
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'back' => Link::make(
                    $this->tasks->backLabel(),
                    $this->tasks->route(),
                ),
                'exit' => Link::make(
                    $this->form->backLabel(),
                    $this->form->exitRoute(),
                ),
            ],
            $this->summary->actions(),
        );
    }
}
