<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Question;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Checkable;

abstract class Task extends Container
{
    use Checkable;
    
    // View
    abstract public function title(): string;

    public function name(): string
    {
        return 'form-builder::items.task';
    }

    public function check(): array
    {
        return [
            $this->title() => 'TASK STATUS',
        ];
    }

    public function checkItems(string $currentPath): array
    {
        $items = [];
        $skipPath = '#';
        $taskPath = "$currentPath/";

        foreach ($this->form->index as $path => $itemClass) {
            if (
                str_starts_with($path, $taskPath) === false
                || str_starts_with($path, $skipPath) === true
            ) {
                continue;
            }

            /** @var Task|Question $item */
            $item = new $itemClass($this->form, $this->model);

            if (is_a($item, Task::class) === true) {
                $skipPath = $path;
            }

            $details = $item->check();

            foreach ($details as $label => $value) {
                $items[] = [
                    'label' => $label,
                    'link' => null,
                    'value' => $value,
                ];
            }
        }

        return $items;
    }
    
    // Routing
    public function backRoute(): string
    {
        // If inside task list, go back to task list
        
        $previousPath = $this->form->previousItemPath($this->model->currentPath);

        if ($previousPath !== null) {
            $count = substr_count($previousPath, '/');

            for ($current = 0; $current <= $count; ++$current) {
                if (array_key_exists($previousPath, $this->form->index) === true) {
                    if (is_a($this->form->index[$previousPath], Task::class, true) === true) {
                        return $this->form->itemRoute($previousPath);
                    }
                }

                $index = strrpos($previousPath, '/');
                $previousPath = substr($previousPath, 0, $index);
            }
        }

        return parent::backRoute();
    }

    public function nextRoute(): string
    {
        $taskPath = $this->model->currentPath;
        $checkPath = $this->model->currentPath;
        $nextPath = $this->form->nextItemPath($checkPath);

        do {
            if (str_starts_with($nextPath, $taskPath) === false) {
                return $this->form->itemRoute($nextPath);
            }

            $checkPath = $nextPath;
            $nextPath = $this->form->nextItemPath($checkPath);
        } while ($nextPath !== null);

        return $this->form->checkRoute();
    }
}

/*
 * TODO Items
 * Status
 * Previous Item path for back
 * Last Item in task needs to back to Task
 * Task is supposed to run linearly, but can be presented as an enterable item
 */
