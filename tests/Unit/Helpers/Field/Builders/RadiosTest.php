<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Builders;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RadiosTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::radios(
            'my-name',
            'My question?',
            [
                'A' => 'Yes',
                'B' => 'No',
            ],
            'My label',
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
            InputType::Radio,
            $this->field->type,
        );
    }
}
