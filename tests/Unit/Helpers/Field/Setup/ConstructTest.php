<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setup;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected Field $field;

    public function testUsesLabel(): void
    {
        $this->field = new Field('my-name', 'My question?', 'My label');

        $this->assertEquals(
            'my-name',
            $this->field->id,
        );

        $this->assertEquals(
            'My label',
            $this->field->displayName,
        );
    }

    public function testGeneratesLabel(): void
    {
        $this->field = new Field('my-name', 'My question?');

        $this->assertEquals(
            'My name',
            $this->field->displayName,
        );
    }
}
