<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use ErrorException;

class MyTask extends Task
{
    public static function key(): string
    {
        return 'my-task';
    }

    public function label(): string
    {
        return 'My task';
    }

    public function questions(): array
    {
        return [
            NameQuestion::class,
            AgeQuestion::class,
            BirthdayQuestion::class,
        ];
    }

    public function checkAccess(): static
    {
        if ($this->form->model->can_access === false) {
            throw new ErrorException();
        }

        return $this;
    }

    public function cannotStart(): bool
    {
        return $this->form->model->cannot_start === true;
    }

    public function isNotRequired(): bool
    {
        return $this->form->model->not_required === true;
    }
}
