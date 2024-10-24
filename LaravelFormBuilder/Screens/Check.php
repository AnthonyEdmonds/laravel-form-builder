<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Screens;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Question;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Screen;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class Check extends Screen
{
    // Setup
    public static function key(): string
    {
        return 'check';
    }

    // View
    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'can_save' => $this->form::SAVE_ENABLED,
                'check' => $this->checkItems(),
            ],
        );
    }

    public function name(): string
    {
        return 'form-builder::screens.check';
    }

    public function checkItems(): array
    {
        $items = [
            0 => [
                'items' => [],
                'link' => null,
                'title' => null,
            ],
        ];
        $skipPath = '#';

        foreach ($this->form->index as $path => $itemClass) {
            if (str_starts_with($path, $skipPath) === true) {
                continue;
            }

            /** @var Task|Question $item */
            $item = new $itemClass($this->form, $this->model);

            if (is_a($item, Task::class) === true) {
                $skipPath = $path;
                $items[] = [
                    'items' => $item->checkItems($path),
                    'link' => $this->form->itemRoute($path),
                    'title' => $item->title(),
                ];

            } else {
                $details = $item->check();
                $first = true;

                foreach ($details as $label => $value) {
                    $items[0]['items'][] = [
                        'label' => $label,
                        'link' => $first === true ? $this->form->itemRoute($path) : null,
                        'value' => $value,
                    ];

                    $first = false;
                }
            }
        }

        return $items;
    }

    // Routing
    public function actionRoute(): ?string
    {
        return $this->form->submitRoute();
    }

    public function backRoute(): string
    {
        return $this->form->itemRoute($this->form->lastItemPath());
    }
    
    public function otherRoute(): ?string
    {
        return $this->form->saveRoute();
    }
}
