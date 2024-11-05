<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface Submits
{
    public function canSubmit(): bool;

    public function submit(): void;
}
