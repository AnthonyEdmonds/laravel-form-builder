<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
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
        return $this->form->exitLabel();
    }

    // CanRender
    public function actions(): array
    {
        return [
            'resume' => Link::make(
                $this->resumeLabel(),
                $this->form->tasks()->route(),
            ),
            'restart' => Link::make(
                $this->restartLabel(),
                $this->form->start()->route(), // TODO Avoid start page on edit
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
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
        return 'Would you like to resume your session?';
    }

    // Actions
    public function show(): View
    {
        return $this;
    }

    public function restartLabel(): string
    {
        return 'Start again';
    }

    public function resumeLabel(): string
    {
        return 'Resume session';
    }
}
