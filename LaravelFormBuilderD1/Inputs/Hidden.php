<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;

class Hidden extends Input
{
    public function __construct(
        string $name, 
        ?string $id = null, 
        mixed $value = null
    ) {
        parent::__construct('', $name, 'off', null, $id, 'hidden', $value);
    }
}
