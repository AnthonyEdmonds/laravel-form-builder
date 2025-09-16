<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\ItemContainer;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class NextItemTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function testRedirectToItem(): void
    {
        $this->redirect = $this->tasks->nextItem('my-task');

        $this->assertEquals(
            $this->tasks->task('next-task')->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testRedirectWhenLastItem(): void
    {
        $this->redirect = $this->tasks->nextItem('next-task');

        $this->assertEquals(
            $this->tasks->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
