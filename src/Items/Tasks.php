<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\TaskNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanSummarise;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

abstract class Tasks extends ItemContainer implements CanRender, CanSummarise
{
    use Renderable;

    // Setup
    final public function __construct(
        public Form $form,
    ) {
        parent::__construct();
    }

    // Item
    public static function key(): string
    {
        return 'tasks';
    }

    public function label(): string
    {
        return 'Tasks';
    }

    public function route(): string
    {
        return route('forms.tasks.show', [
            $this->form->key,
        ]);
    }

    public function backLabel(): string
    {
        return 'Back to task list';
    }

    // Container
    /** @returns class-string<Task>[]|array<string, class-string<Task>[]> */
    abstract public function tasks(): array;

    /** @param Task $item */
    public function formatItem(ItemInterface $item): array
    {
        return $this->formatTask($item);
    }

    /** @returns class-string<Task>[] */
    public function items(): array
    {
        $items = [];
        $tasks = $this->tasks();

        foreach ($tasks as $task) {
            if (is_array($task) === true) {
                foreach ($task as $subtask) {
                    $items[] = $subtask;
                }
            } else {
                $items[] = $task;
            }
        }

        return $items;
    }

    /** @param class-string<Task> $itemClass */
    public function makeItem(string $itemClass): Task
    {
        $task = new $itemClass($this->form, $this);
        $task->group = $this->findTaskGroup($itemClass);

        return $task;
    }

    public function task(string $taskKey): Task
    {
        /** @var ?Task $task */
        $task = $this->findItem($taskKey);

        return $task
            ?? throw new TaskNotFound("No task has been registered on this form with the key \"$taskKey\"");
    }

    protected function formatTask(Task $task): array
    {
        return $task->format();
    }

    protected function findTaskGroup(string $taskClass): ?string
    {
        $tasks = $this->tasks();

        foreach ($tasks as $label => $group) {
            if (
                is_array($group) === true
                && in_array($taskClass, $group) === true
            ) {
                return $label;
            }
        }

        return null;
    }

    // CanRender
    public function actions(): array
    {
        $summary = $this->form->summary();

        return [
            'summary' => Link::make(
                $summary->showLabel(),
                $summary->route(),
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
        ];
    }

    public function blade(): string
    {
        return 'form-builder::tasks';
    }

    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->label() => $this->route(),
        ];
    }

    public function title(): string
    {
        $class = $this->form->model->modelName();
        $key = $this->form->model->getKey();

        return $this->form->model->exists === true
            ? "Editing $class #$key"
            : "Create a new $class";
    }

    // CanSummarise
    public function summarise(bool $hasActions, bool $hasStatuses): array
    {
        $summary = [];

        $tasks = $this->items();
        foreach ($tasks as $taskClass) {
            $task = $this->makeItem($taskClass);
            $summary[] = $task->summarise($hasActions, $hasStatuses);
        }

        return $summary;
    }

    public function canChange(): bool
    {
        return true;
    }

    public function changeLabel(): string
    {
        return 'Change';
    }

    // Actions
    public function show(): View
    {
        $this->with('tasks', $this->formatItems());

        if ($this->form->model->draftIsEnabled() === true) {
            $this->with('draft', Link::make(
                $this->form->draftLabel(),
                $this->form->draftRoute(),
            ));
        }

        return $this->render();
    }
}
