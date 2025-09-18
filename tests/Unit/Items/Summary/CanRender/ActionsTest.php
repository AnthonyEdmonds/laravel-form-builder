<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Summary\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Summary;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
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
        $this->assertEquals(
            [
                'Back to tasks' => $this->form->tasks()->route(),
                'Exit' => $this->form->exitRoute(),
            ],
            $this->summary->actions(),
        );
    }
}
