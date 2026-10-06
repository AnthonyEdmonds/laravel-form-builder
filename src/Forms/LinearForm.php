<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Tasks\LinearTasks;

abstract class LinearForm extends Form
{
    abstract public function questions(): array;

    public function tasks(): Tasks
    {
        $tasks = new LinearTasks($this);
        $tasks->setQuestions($this->questions());

        return $tasks;
    }
}
