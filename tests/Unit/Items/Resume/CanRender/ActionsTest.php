<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Resume\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
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
                'Resume session' => $this->form->tasks()->route(),
                'Start again' => $this->form->start()->route(),
                'Exit' => $this->form->exitRoute(),
            ],
            $this->resume->actions(),
        );
    }
}
