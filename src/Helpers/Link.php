<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

class Link
{
    final public function __construct(
        public string $label,
        public string $link,
    ) {
        //
    }

    public static function make(
        string $label,
        string $link,
    ): static {
        return new static($label, $link);
    }
}
