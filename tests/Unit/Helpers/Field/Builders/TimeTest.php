<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class TimeTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::time(
            'my-name',
            'My question?',
            'My label',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'time-input',
            $this->field->blade,
        );

        $this->assertEquals(
            InputType::Time,
            $this->field->type,
        );
    }
}
