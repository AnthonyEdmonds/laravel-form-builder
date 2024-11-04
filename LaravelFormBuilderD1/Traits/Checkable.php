<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

trait Checkable
{
    /** @return array<string, scalar> Format this Item for review */
    abstract public function check(): array;
}
