<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

class Summary extends Item implements ItemInterface, CanRender
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
        return 'summary';
    }

    public function label(): string
    {
        return 'Check your answers';
    }

    public function route(): string
    {
        return route('forms.summary.show', $this->form->key);
    }

    // CanRender
    public function actions(): array
    {
        return [
            'Back to tasks' => $this->form->tasks()->route(), // TODO Customisable labels
            'Exit' => $this->form->exitRoute(), // TODO Customisable labels
        ];
    }

    public function blade(): string
    {
        return 'form-builder::summary';
    }

    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->form->tasks()->label() => $this->form->tasks()->route(),
            $this->label() => $this->route(),
        ];
    }

    public function title(): string
    {
        return $this->label();
    }

    // Actions
    public function show(): View
    {
        $summary = [];
        $tasks = $this->form->tasks();
        $taskClasses = $tasks->tasks(); // TODO Move to Tasks

        foreach ($taskClasses as $taskClass) {
            $task = $tasks->makeItem($taskClass);

            $label = $task->label();
            $taskOverview = $tasks->formatItem($task);
            $taskOverview['questions'] = $task->formatItems();

            $summary[$label] = $taskOverview;
        }

        $this
            ->with('submit', [
                'label' => $this->form->submitLabel(),
                'link' => $this->form->submitRoute(),
            ])
            ->with('summary', $summary);

        if ($this->form->model->draftIsEnabled() === true) {
            $this->with('draft', [
                'label' => $this->form->draftLabel(),
                'link' => $this->form->draftRoute(),
            ]);
        }

        return $this;
    }
}
