<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

class Confirmation extends Item implements ItemInterface, CanRender
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
        return 'confirmation';
    }

    public function label(): string
    {
        return 'Confirmation';
    }

    public function route(): string
    {
        return route('forms.confirmation.show', $this->form->key);
    }

    public function backLabel(): string
    {
        return $this->form->exitLabel();
    }

    public function isEnabled(): bool
    {
        return $this->form->confirmationIsEnabled();
    }

    // CanRender
    public function actions(): array
    {
        return [
            'view' => Link::make(
                $this->form->model->viewLabel(),
                $this->form->model->viewRoute(),
            ),
            'restart' => Link::make(
                $this->form->resume()->restartLabel(),
                $this->form->newRoute(),
            ),
            'exit' => Link::make(
                $this->form->exitLabel(),
                $this->form->exitRoute(),
            ),
        ];
    }

    public function blade(): string
    {
        return 'form-builder::confirmation';
    }

    public function breadcrumbs(): array
    {
        return [
            $this->form->label(),
            $this->label(),
        ];
    }

    public function title(): string
    {
        $class = $this->form->model->modelName();

        return "$class submitted";
    }

    // Actions
    public function show(): View
    {
        return $this
            ->with('hideTitle', true)
            ->with('model', $this->form->model);
    }
}
