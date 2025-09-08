<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Enums\State;

interface UsesStates
{
    public function checkItemsStatuses(): array;

    public function status(): State;

    public function statusColour(): Colour;

    // Statuses
    public function cannotStart(): bool;

    public function isComplete(): bool;

    public function isInProgress(): bool;

    public function isIncomplete(): bool;

    public function isNotRequired(): bool;

    public function hasNotBeenStarted(): bool;

    public function hasError(): bool;
}
