<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tasks;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;

class LinearTasks extends Tasks
{
    /** @var Question[]  */
    public array $questions = [];

    public function tasks(): array
    {
        return [
            LinearTask::class,
        ];
    }

    public function route(): string
    {
        return $this
            ->task(LinearTask::key())
            ->route();
    }

    public function backLabel(): string
    {
        return '';
    }
}
