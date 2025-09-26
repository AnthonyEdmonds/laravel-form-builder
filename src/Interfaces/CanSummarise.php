<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface CanSummarise
{
    public function summarise(bool $hasActions): array;
}
