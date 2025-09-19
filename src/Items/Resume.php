<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

class Resume extends Item implements ItemInterface, CanRender
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
        return 'resume';
    }

    public function label(): string
    {
        return 'Resume';
    }

    public function route(): string
    {
        return route('forms.resume.show', $this->form->key);
    }

    public function backLabel(): string
    {
        return $this->form->backLabel();
    }

    // CanRender
    public function actions(): array
    {
        return [
            'Resume session' => $this->form->tasks()->route(),
            'Start again' => $this->form->start()->route(),
            'Exit' => $this->form->exitRoute(),
        ];
    }

    public function blade(): string
    {
        return 'form-builder::resume';
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
        return 'Do you want to resume your last session?';
    }

    // Actions
    public function show(): View
    {
        return $this;
    }
}
