<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setters;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SetAttributeTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My label');

    }

    public function test(): void
    {
        $this->field->setAttribute('my_attribute');

        $this->assertEquals(
            'my_attribute',
            $this->field->attribute,
        );
    }
}
