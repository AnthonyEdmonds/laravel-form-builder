<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;

/** @mixin UsesStates */
trait HasStates
{
    // TODO Based on Questions for Task
    // TODO Based on answer validity for Question
    abstract public function checkItemsStatuses(): array;

    public function status(): State
    {
        return match (true) {
            $this->isNotRequired() => State::NotRequired,
            $this->hasError() => State::ThereIsAProblem,
            $this->isIncomplete() => State::Incomplete,
            $this->isInProgress() => State::InProgress,
            $this->hasNotBeenStarted() => State::NotYetStarted,
            $this->cannotStart() => State::CannotStartYet,
            $this->isComplete() => State::Completed,
            default => State::Unknown,
        };
    }

    public function statusColour(): Colour
    {
        return $this->status()->colour();
    }

    // Statuses
    abstract public function cannotStart(): bool;

    abstract public function isComplete(): bool;

    abstract public function isInProgress(): bool;

    abstract public function isIncomplete(): bool;

    abstract public function isNotRequired(): bool;

    abstract public function hasNotBeenStarted(): bool;

    abstract public function hasError(): bool;
}
