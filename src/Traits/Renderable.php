<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\CanRender;

/** @mixin CanRender */
trait Renderable
{
    protected array $data = [];

    // CanRender
    abstract public function actions(): array;

    abstract public function blade(): string;

    abstract public function breadcrumbs(): array;

    abstract public function title(): string;

    public function description(): array
    {
        return [];
    }

    // View
    public function name(): string
    {
        return $this->blade();
    }

    public function with($key, $value = null): static
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(
            $this->data,
            [
                'actions' => $this->actions(),
                'breadcrumbs' => $this->breadcrumbs(),
                'description' => $this->description(),
                'title' => $this->title(),
            ],
        );
    }

    // Renderable
    public function render(): string
    {
        return view(
            $this->blade(),
            $this->getData(),
        );
    }
}
