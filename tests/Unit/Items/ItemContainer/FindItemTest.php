<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\ItemContainer;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FindItemTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();
    }

    public function testItemWhenFound(): void
    {
        $this->assertInstanceOf(
            MyTask::class,
            $this->tasks->findItem('my-task'),
        );
    }

    public function testNullWhenNot(): void
    {
        $this->assertNull(
            $this->tasks->findItem('potato'),
        );
    }
}
