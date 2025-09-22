<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

class Link
{
    final public function __construct(
        public string $label,
        public string $link,
        public string $method = 'GET',
    ) {
        //
    }

    public static function make(
        string $label,
        string $link,
        string $method = 'GET',
    ): static {
        return new static($label, $link, $method);
    }
}
