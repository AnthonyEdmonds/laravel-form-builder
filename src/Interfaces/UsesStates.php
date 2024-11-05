<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Enums\State;

interface UsesStates
{
    public function status(): State;

    public function statusColour(): Colour;
}
