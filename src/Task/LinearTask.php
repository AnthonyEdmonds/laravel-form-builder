<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Task;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tasks\LinearTasks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

/** @property LinearTasks $tasks */
class LinearTask extends Task
{
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
        return $this->tasks->questions;
    }

    public function route(): string
    {
        $firstQuestion = array_first($this->tasks->questions);

        return $this->question($firstQuestion::key())->route();
    }

    public function backLabel(): string
    {
        return '';
    }

    public function nextItem(string $currentKey): RedirectResponse
    {
        $nextItem = $this->findNextItem(
            $currentKey,
            $this->items(),
        );

        return Redirect::to(
            $nextItem !== null
                ? $nextItem->route()
                : $this->form->summary()->route(),
        );
    }
}
