<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;
use Illuminate\Support\Collection;

class Select extends Input
{
    public array $options;

    public function __construct(
        string $label,
        string $name,
        string $autocomplete = 'on',
        ?string $hint = null,
        ?string $id = null,
        mixed $value = null,
        Collection|array $options = [],
    ) {
        parent::__construct($label, $name, $autocomplete, $hint, $id, 'select', $value);

        $this->options = is_a($options, Collection::class) === true
            ? $options->toArray()
            : $options;
    }
}
