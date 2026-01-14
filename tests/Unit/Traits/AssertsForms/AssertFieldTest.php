<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\CanRender;

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
    }
}
