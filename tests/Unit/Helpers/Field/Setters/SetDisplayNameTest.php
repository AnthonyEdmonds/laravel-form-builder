<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setters;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SetDisplayNameTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My question');
        $this->field->setDisplayName('My display name');
    }

    public function test(): void
    {
        $this->assertEquals(
            'My display name',
            $this->field->displayName,
        );
    }
}
