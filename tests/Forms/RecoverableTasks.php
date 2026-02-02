<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;

class RecoverableTasks extends Tasks
{
    public function tasks(): array
    {
        return [
            RecoverableTask::class,
        ];
    }
}
