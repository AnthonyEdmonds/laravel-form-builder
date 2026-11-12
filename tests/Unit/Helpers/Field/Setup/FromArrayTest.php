<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setup;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FromArrayTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::fromArray([
            'displayName' => 'My display name',
            'label' => 'My label',
            'name' => 'my-name',
            'unknown' => 'blah',
            'value' => 'value',
        ]);
    }

    public function test(): void
    {
        $this->assertEquals(
            'My display name',
            $this->field->displayName,
        );

        $this->assertEquals(
            'My label',
            $this->field->label,
        );

        $this->assertEquals(
            'my-name',
            $this->field->name,
        );

        $this->assertEquals(
            'value',
            $this->field->value,
        );
    }
}
