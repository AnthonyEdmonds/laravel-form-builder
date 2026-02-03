<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\CanRender;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class AssertFieldTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::readonly(
            'My title',
            'My value',
        );
    }

    public function test(): void
    {
        $this->assertField(
            [
                'label' => 'My title',
                'value' => 'My value',
            ],
            $this->field,
        );

        $this->field = Field::input(
            'fruit',
            'Which fruit would you like? (optional)',
        )->optional();

        $this->assertField(
            [
                'inputmode' => InputType::Text,
                'label' => 'Which fruit would you like?',
            ],
            $this->field,
        );
    }
}
