<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\TaskNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

abstract class Tasks extends ItemContainer implements CanRender
{
    use Renderable;

    // Setup
    final public function __construct(
        public Form $form,
    ) {
        parent::__construct();
    }

    // Item
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

    // Container
    /** @returns class-string<Task>[] */
    abstract public function tasks(): array; // TODO V2: task groups

    /** @param Task $item */
    public function formatItem(ItemInterface $item): array
    {
        return $this->formatTask($item);
    }

    /** @returns class-string<Task>[] */
    public function items(): array
    {
        return $this->tasks();
    }

    /** @param class-string<Task> $itemClass */
    public function makeItem(string $itemClass): Task
    {
        return new $itemClass($this->form);
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
        return [
            'colour' => $task->statusColour(),
            'label' => $task->label(),
            'link' => $task->route(),
            'status' => $task->status(),
        ];
    }

    // CanRender
    public function actions(): array
    {
        $actions = [
            'Check answers' => $this->form->summary()->route(),
        ];

        if ($this->form->model->draftIsEnabled() === true) {
            $actions['Save as draft'] = $this->form->draftRoute();
        }

        $actions['Exit'] = $this->form->exitRoute();

        return $actions;
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

    // Actions
    public function show(): View
    {
        return $this->with('tasks', $this->formatItems());
    }
}
