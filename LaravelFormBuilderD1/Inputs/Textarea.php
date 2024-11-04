<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;

class Textarea extends Input
{
    public function __construct(
        string $label,
        string $name,
        string $autocomplete = 'on',
        ?string $hint = null,
        ?string $id = null,
        mixed $value = null,
        public string $inputmode = 'text',
        public ?string $placeholder = null,
        public int $rows = 5,
        public string $spellcheck = 'false',
    ) {
        parent::__construct($label, $name, $autocomplete, $hint, $id, 'textarea', $value);
    }
}
