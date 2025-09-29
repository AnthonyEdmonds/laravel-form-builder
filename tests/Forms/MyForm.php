<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use ErrorException;

class MyForm extends Form
{
    public static function key(): string
    {
        return 'my-form';
    }

    public function tasks(): Tasks
    {
        return new MyTasks($this);
    }

    public static function modelClass(): string
    {
        return MyModel::class;
    }

    public function checkAccess(): static
    {
        if ($this->model->can_access === false) {
            throw new ErrorException();
        }

        return $this;
    }
}
