<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SelectTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::select(
            'my-name',
            'My label',
            [
                'A' => 'Yes',
                'B' => 'No',
            ],
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                'A' => 'Yes',
                'B' => 'No',
            ],
            $this->field->options,
        );

        $this->assertEquals(
            InputType::Select,
            $this->field->type,
        );
    }
}
