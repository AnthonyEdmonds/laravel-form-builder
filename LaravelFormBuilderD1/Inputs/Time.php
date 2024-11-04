<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;
use Carbon\Carbon;

class Time extends Input
{
    public function __construct(
        string $label,
        string $name,
        string $autocomplete = 'on',
        ?string $hint = null,
        ?string $id = null,
        mixed $value = null,
    ) {
        $value = is_a($value, Carbon::class) === true
            ? $value->format('H:i')
            : $value;

        parent::__construct($label, $name, $autocomplete, $hint, $id, 'time', $value);
    }
}
