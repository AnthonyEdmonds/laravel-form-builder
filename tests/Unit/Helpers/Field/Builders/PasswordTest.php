<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class PasswordTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::password(
            'my-name',
            'My question?',
            'My label',
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            'password',
            $this->field->blade,
        );

        $this->assertEquals(
            InputType::Password,
            $this->field->type,
        );
    }
}
