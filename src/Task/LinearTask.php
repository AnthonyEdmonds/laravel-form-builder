<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Task;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class LinearTask extends Task
{
    /** @var Question[]  */
    protected array $questions = [];

    public function setQuestions(array $questions): void
    {
        $this->questions = $questions;
    }

    public static function key(): string
    {
        return 'linear';
    }

    public function label(): string
    {
        return 'Task';
    }

    public function questions(): array
    {
        return $this->questions;
    }

    public function route(): string
    {
        $firstQuestion = array_first($this->questions);

        return $this->question($firstQuestion::key())->route();
    }
}
