<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class DateTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::date(
            'my-name',
            'My question?',
            'My label',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'date-input',
            $this->field->blade,
        );

        $this->assertEquals(
            InputType::Date,
            $this->field->type,
        );
    }
}
