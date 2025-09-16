<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

/**
 * @property int $id
 */
class NonDraftModel extends MyModel
{
    // UsesForm
    public function draftIsEnabled(): bool
    {
        return false;
    }
}
