<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\ItemContainer;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FindNextItemTest extends TestCase
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
            NextTask::class,
            $this->tasks->findNextItem('my-task', $this->taskList),
        );
    }

    public function testNullWhenLastItem(): void
    {
        $this->assertNull(
            $this->tasks->findNextItem('next-task', $this->taskList),
        );
    }

    public function testNullWhenNot(): void
    {
        $this->assertNull(
            $this->tasks->findNextItem('potato', $this->taskList),
        );
    }
}
