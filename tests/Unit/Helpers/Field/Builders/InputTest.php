<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class InputTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::input(
            'my-name',
            'My question?',
            InputType::Date,
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
            InputType::Date,
            $this->field->type,
        );
    }
}
