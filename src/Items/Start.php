<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class Start extends Item implements ItemInterface, CanRender
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
        return 'start';
    }

    public function label(): string
    {
        return 'Start';
    }

    public function route(): string
    {
        return route('forms.start.show', $this->form->key);
    }

    public function backLabel(): string
    {
        return $this->form->backLabel();
    }

    // CanRender
    public function actions(): array
    {
        return [
            'Start' => $this->form->tasks()->route(),
            'Exit' => $this->form->exitRoute(),
        ];
    }

    public function blade(): string
    {
        return 'form-builder::start';
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

        return "Create a new $class";
    }

    // Actions
    public function fresh(): RedirectResponse
    {
        SessionHelper::setFormSession($this->form->key, $this->form->model);

        return Redirect::to(
            $this->form->tasks()->route(),
        );
    }

    public function show(): View
    {
        return $this;
    }
}
