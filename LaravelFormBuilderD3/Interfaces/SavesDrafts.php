<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface SavesDrafts
{
    public function canSaveDraft(): bool;

    public function saveDraft(): void;
}
