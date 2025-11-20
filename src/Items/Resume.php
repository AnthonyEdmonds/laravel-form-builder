<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Link;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\ModelHelper;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
                $this->restartRoute(),
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
        return $this
            ->with('model', $this->form->model)
            ->render();
    }

    public function restart(): RedirectResponse
    {
        $isEditing = $this->form->model->exists === true;

        SessionHelper::setFormSession(
            $this->form->key,
            $isEditing === true
                ? ModelHelper::loadModelFromDatabase($this->form::class, $this->form->model->getKey())
                : ModelHelper::newModel($this->form::class),
        );

        return Redirect::to(
            match (true) {
                $isEditing === true,
                $this->form->startIsEnabled() === false => $this->form->tasks()->route(),
                default => $this->form->start()->route(),
            },
        );
    }

    public function restartLabel(): string
    {
        return 'Start again';
    }

    public function restartRoute(): string
    {
        return route('forms.resume.restart', $this->form->key);
    }

    public function resumeLabel(): string
    {
        return 'Resume session';
    }
}
