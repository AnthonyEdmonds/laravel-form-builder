<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ReadonlyTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::readonly(
            'My label',
            'My value',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'My label',
            $this->field->name,
        );

        $this->assertEquals(
            'My label',
            $this->field->label,
        );

        $this->assertEquals(
            'My label',
            $this->field->displayName,
        );

        $this->assertEquals(
            InputType::ReadOnly,
            $this->field->type,
        );

        $this->assertEquals(
            'My value',
            $this->field->value,
        );
    }
}
