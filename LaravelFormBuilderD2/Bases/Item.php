<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\HasKey;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

abstract class Item implements View
{
    use HasKey;
    use Renderable;

    public Form $form;

    protected Model $model;

    protected Form|Item|Container $parent;

    // Setup
    public function __construct(Model $model, Form|Item|Container $parent)
    {
        $this->model = $model;
        $this->parent = $parent;
        $this->form = is_a($this->parent, Form::class) === true
            ? $this->parent
            : $this->parent->form;
    }

    // Actions
    public function show(): View
    {
        return $this;
    }

    public function save(): RedirectResponse
    {
        //
    }

    public function skip(): RedirectResponse
    {
        //
    }

    public function delete(): RedirectResponse
    {
        //
    }

    /** Get the next Item from the parent container */
    public function nextItem(): Item|Container|null
    {
        return $this->parent->getNextItem($this);
    }

    // Routing
    public function route(): string
    {
        $keys = array_reverse($this->structure());
        $keys = implode('/', $keys);

        return route('form-builder.item', [$this->form::KEY, $keys]);
    }

    public function structure(array &$keys = []): array
    {
        array_unshift($keys, $this::KEY);

        return is_a($this->parent, Form::class) !== true
            ? $this->parent->structure($keys)
            : $keys;
    }
}
