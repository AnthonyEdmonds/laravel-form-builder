<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FileTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::file(
            'my-name',
            'My label',
            'text/csv',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'text/csv',
            $this->field->accept,
        );

        $this->assertEquals(
            InputType::File,
            $this->field->type,
        );
    }
}
