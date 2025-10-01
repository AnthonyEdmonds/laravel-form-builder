<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RangeTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::range(
            'my-name',
            'My question?',
            0,
            '1.23',
            0.01,
            'My label',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'text-input',
            $this->field->blade,
        );

        $this->assertEquals(
            '1.23',
            $this->field->max,
        );

        $this->assertEquals(
            '0',
            $this->field->min,
        );

        $this->assertEquals(
            '0.01',
            $this->field->step,
        );

        $this->assertEquals(
            InputType::Range,
            $this->field->type,
        );
    }
}
