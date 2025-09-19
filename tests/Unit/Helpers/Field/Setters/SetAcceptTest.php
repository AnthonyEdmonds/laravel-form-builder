<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setters;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SetAcceptTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My label');

    }

    public function testAcceptsArray(): void
    {
        $this->field->setAccept([
            'text/csv',
            'image/jpg',
        ]);

        $this->assertEquals(
            'text/csv,image/jpg',
            $this->field->accept,
        );
    }

    public function testAcceptsString(): void
    {
        $this->field->setAccept('accept');

        $this->assertEquals(
            'accept',
            $this->field->accept,
        );
    }
}
