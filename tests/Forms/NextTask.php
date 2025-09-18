<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;

class NextTask extends Task
{
    public static function key(): string
    {
        return 'next-task';
    }

    public function label(): string
    {
        return 'Next task';
    }

    public function questions(): array
    {
        return [
            AgeQuestion::class,
        ];
    }

    // HasStates
    public function hasError(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 1;
    }

    public function hasNotBeenStarted(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 2;
    }

    public function isComplete(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 3;
    }

    public function cannotStart(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 4;
    }

    public function isInProgress(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 5;
    }

    public function isNotRequired(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 6;
    }

    public function isIncomplete(): bool
    {
        return $this
            ->question('age-question')
            ->getAnswer('age') === 7;
    }
}
