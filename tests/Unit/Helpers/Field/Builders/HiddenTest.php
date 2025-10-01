<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class HiddenTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::hidden(
            'my-name',
            'My value',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'hidden-input',
            $this->field->blade,
        );

        $this->assertEquals(
            InputType::Hidden,
            $this->field->type,
        );

        $this->assertEquals(
            'My value',
            $this->field->value,
        );
    }
}
