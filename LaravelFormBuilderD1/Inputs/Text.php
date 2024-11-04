<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;

class Text extends Input
{
    public function __construct(
        string $label,
        string $name,
        string $autocomplete = 'on',
        ?string $hint = null,
        ?string $id = null,
        string $type = 'text',
        mixed $value = null,
        public string $inputmode = 'text',
        public ?string $placeholder = null,
        public ?int $size = null,
        public string $spellcheck = 'false',
    ) {
        parent::__construct($label, $name, $autocomplete, $hint, $id, $type, $value);
    }
}
