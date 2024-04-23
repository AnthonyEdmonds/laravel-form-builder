<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

trait Renderable
{
    public array $data = [];

    abstract public function name(): string;

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
