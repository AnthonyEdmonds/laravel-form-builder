<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;

class MyTasks extends Tasks
{
    public function tasks(): array
    {
        return [
            MyTask::class,
        ];
    }
}
