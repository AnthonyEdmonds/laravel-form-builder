<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;

/** @mixin UsesStates */
trait HasStates
{
    protected ?State $status = null;

    public function checkStatus(): State
    {
        return $this->matchStatus();
    }

    public function matchStatus(): State
    {
        return match (true) {
            $this->isNotRequired() => State::NotRequired,
            $this->hasNotBeenStarted() => State::NotYetStarted,
            $this->hasError() => State::ThereIsAProblem,
            $this->isIncomplete() => State::Incomplete,
            $this->isInProgress() => State::InProgress,
            $this->cannotStart() => State::CannotStartYet,
            $this->isComplete() => State::Completed,
            default => State::Unknown,
        };
    }

    public function status(): State
    {
        if ($this->status === null) {
            $this->status = $this->checkStatus();
        }

        return $this->status;
    }

    public function statusColour(): Colour
    {
        return $this->status()->colour();
    }

    // Statuses
    abstract public function hasError(): bool;

    abstract public function hasNotBeenStarted(): bool;

    abstract public function isComplete(): bool;

    public function cannotStart(): bool
    {
        return false;
    }

    public function isInProgress(): bool
    {
        return false;
    }

    public function isNotRequired(): bool
    {
        return false;
    }

    public function isIncomplete(): bool
    {
        return false;
    }
}
