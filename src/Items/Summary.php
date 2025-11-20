<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
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

    public function backLabel(): string
    {
        return $this->form->tasks()->backLabel();
    }

    // CanRender
    public function actions(): array
    {
        $tasks = $this->form->tasks();

        return [
            'back' => Link::make(
                $tasks->backLabel(),
                $tasks->route(),
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
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
        $this
            ->with('model', $this->form->model)
            ->with('submit', Link::make(
                $this->form->submitLabel(),
                $this->form->submitRoute(),
            ))
            ->with('summary', $this->form->tasks()->summarise(true, true));

        if ($this->form->model->draftIsEnabled() === true) {
            $this->with('draft', Link::make(
                $this->form->draftLabel(),
                $this->form->draftRoute(),
            ));
        }

        return $this->render();
    }

    public function showLabel(): string
    {
        return 'Check answers';
    }
}
