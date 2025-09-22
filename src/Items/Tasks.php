<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\TaskNotFound;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanSummarise;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

// TODO v2 Task groups
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
        return 'Back to tasks';
    }

    // Container
    /** @returns class-string<Task>[] */
    abstract public function tasks(): array;

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
        return new $itemClass($this->form, $this);
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
        $summary = $this->form->summary();

        return [
            'summary' => Link::make(
                $summary->showLabel(),
                $summary->route(),
            ),
            'exit' => Link::make(
                $this->form->backLabel(),
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
    public function summarise(): array
    {
        $summary = [];
        $taskClasses = $this->tasks();

        foreach ($taskClasses as $taskClass) {
            $task = $this->makeItem($taskClass);
            $summary[] = $task->summarise();
        }

        return $summary;
    }

    // Actions
    public function show(): View
    {
        $this->with('tasks', $this->formatItems());

        if ($this->form->model->draftIsEnabled() === true) {
            $this->with('draft', [
                'label' => $this->form->draftLabel(),
                'link' => $this->form->draftRoute(),
            ]);
        }

        return $this;
    }
}
