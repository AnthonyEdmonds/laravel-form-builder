<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tasks;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;

class LinearTasks extends Tasks
{
    /** @var Question[]  */
    protected array $questions = [];

    public function setQuestions(array $questions): void
    {
        $this->questions = $questions;
    }

    public function tasks(): array
    {
        $task = new LinearTask($this->form, $this);
        $task->setQuestions($this->questions);

        return [$task];
    }

    public function route(): string
    {
        return $this->task(LinearTask::key())->route();
    }
}
