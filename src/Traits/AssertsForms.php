<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;

trait AssertsForms
{
    protected function assertField(array $expectations, Field $field): void
    {
        foreach ($expectations as $key => $value) {
            if ($value instanceof InputType === true) {
                $value = $value->value;
            }

            if (
                $key === 'label'
                && $field->optional === true
            ) {
                $value .= ' (optional)';
            }

            $this->assertEquals(
                $value,
                $field->$key,
            );
        }
    }
}
