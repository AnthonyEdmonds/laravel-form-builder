<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use Illuminate\Contracts\View\View;

interface CanRender extends View
{
    public function actions(): array;

    public function blade(): string;

    public function breadcrumbs(): array;

    public function description(): array;

    public function title(): string;

    // View
    public function name(): string;

    public function with($key, $value = null): static;

    public function getData(): array;

    // Renderable
    public function render(): string;
}
