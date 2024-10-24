<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

trait Renderable
{
    /** @var array Data available to the blade */
    public array $data = [];
    
    /** The name of the blade used to display this class */
    abstract public function name(): string;
    
    /** Class properties which will be merged with the $data when rendered */
    abstract public function toArray(): array;

    /** Get the data available to the blade */
    public function getData(): array
    {
        return array_merge($this->data, $this->toArray());
    }

    /** Render the blade */
    public function render(): string
    {
        return view($this->name(), $this->getData())->render();
    }

    /**
     * Add data to be available on the blade
     * @param string|int|array $key
     */
    public function with($key, mixed $value = null): static
    {
        is_array($key) === true
            ? $this->data = array_merge($this->data, $key)
            : $this->data[$key] = $value;

        return $this;
    }
}
