<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Resume\Actions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class RestartTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Resume $resume;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->id = 1;
        $this->model->name = 'Bob';

        $this->form = new MyForm($this->model);
        $this->resume = $this->form->resume();
    }

    public function testWhenEditing(): void
    {
        $this->model->save();
        $this->model->name = 'Trevor';

        $this->redirect = $this->resume->restart();

        $this->assertEquals(
            'Bob',
            SessionHelper::getFormSession($this->form->key)->name,
        );

        $this->assertEquals(
            $this->form->tasks()->route(),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testWhenNew(): void
    {
        $this->redirect = $this->resume->restart();

        $this->assertNull(
            SessionHelper::getFormSession($this->form->key)->name,
        );

        $this->assertEquals(
            $this->form->start()->route(),
            $this->redirect->getTargetUrl(),
        );
    }
}
