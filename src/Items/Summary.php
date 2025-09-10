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
            'Submit' => $this->form->submitRoute(),
            'Save as draft' => $this->form->draftRoute(),
            'Back to tasks' => $this->form->tasks()->route(),
            'Exit' => $this->form->exitRoute(),
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

        // TODO Each Task
        // TODO Each Question

        return $this->with('summary', $summary);
    }
}
