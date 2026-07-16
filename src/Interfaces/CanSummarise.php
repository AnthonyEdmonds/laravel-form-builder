<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface CanSummarise
{
    public function summarise(bool $hasActions, bool $hasStatuses): array;

    public function canChange(): bool;

    public function changeLabel(): string;

    public function hasSecondarySummaries(): bool;

    public function secondarySummaries(): array;
}
