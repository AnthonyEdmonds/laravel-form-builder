<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\ItemContainer;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FindPreviousItemTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Tasks $tasks;

    protected array $taskList;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->tasks = $this->form->tasks();

        $this->taskList = [
            MyTask::class,
            NextTask::class,
        ];
    }

    public function testItemWhenFound(): void
    {
        $this->assertInstanceOf(
            MyTask::class,
            $this->tasks->findPreviousItem('next-task', $this->taskList),
        );
    }

    public function testNullWhenFirstItem(): void
    {
        $this->assertNull(
            $this->tasks->findPreviousItem('my-task', $this->taskList),
        );
    }

    public function testNullWhenNot(): void
    {
        $this->assertNull(
            $this->tasks->findPreviousItem('potato', $this->taskList),
        );
    }
}
