<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Tasks\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class BackLabelTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function test(): void
    {
        $this->assertEquals(
            'Back to task list',
            $this->tasks->backLabel(),
        );
    }
}
