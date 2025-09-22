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
        return $this->form->backLabel();
    }

    // CanRender
    public function actions(): array
    {
        return [
            'view' => Link::make(
                $this->viewLabel(),
                $this->form->model->viewRoute(),
            ),
            'exit' => Link::make(
                $this->form->backLabel(),
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
        $key = $this->form->model->getKey();

        return "$class #$key has been submitted";
    }

    // Actions
    public function show(): View
    {
        return $this;
    }

    public function viewLabel(): string
    {
        return 'View' . $this->form->model->modelName();
    }
}
