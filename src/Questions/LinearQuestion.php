<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;

/**
 * @property LinearTask $task
 * @mixin Question
 */
trait LinearQuestion
{
    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->label() => $this->route(),
        ];
    }

    public function actions(): array
    {
        if ($this->returnToSummary === true) {
            $label = 'Back to check answers';
            $link = $this->form->summary()->route();

        } else {
            $previousItem = $this->task->findPreviousItem(static::key(), $this->task->tasks->questions);

            if ($previousItem === null) {
                $label = $this->form->exitLabel();
                $link = $this->form->exitRoute();
            } else {
                $label = 'Previous question';
                $link = $previousItem->route();
            }
        }

        $back = Link::make($label, $link);

        return [
            'back' => $back,
            'task' => $back,
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
        ];
    }
}
