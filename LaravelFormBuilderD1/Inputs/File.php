<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;

class File extends Input
{
    public string $accept;

    public function __construct(
        string $label,
        string $name,
        ?string $hint = null,
        ?string $id = null,
        mixed $value = null,
        array|string $accept = '*',
    ) {
        parent::__construct($label, $name, 'off', $hint, $id, 'file', $value);

        $this->accept = $this->setAccept($accept);
    }

    public function setAccept(array|string $accept): string
    {
        if (empty($accept) === true) {
            return '*';
        }

        return is_array($accept) === true
            ? implode(',', $accept)
            : $accept;
    }
}
