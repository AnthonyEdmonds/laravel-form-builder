<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use Illuminate\Contracts\View\View;

abstract class RenderableFormItem extends FormItem implements View
{
    public array $data = [];
    
    public function getData(): array
    {
        return $this->data;
    }

    public function render(): string
    {
        return view($this->name(), $this->data)->render();
    }

    /**
     * @param  string|array  $key
     * @param  mixed  $value
     */
    public function with($key, $value = null): static
    {
        is_array($key) === true
            ? $this->data = $key
            : $this->data[$key] = $value;

        return $this;
    }
}
