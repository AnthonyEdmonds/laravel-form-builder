<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setters;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Support\Collection;

class SetOptionsTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My label');

    }

    public function testHandlesCollection(): void
    {
        $this->field->setOptions(
            new Collection([
                'A' => 'Yes',
                'B' => 'No',
            ]),
        );

        $this->assertEquals(
            [
                'A' => 'Yes',
                'B' => 'No',
            ],
            $this->field->options,
        );
    }

    public function testHandlesArray(): void
    {
        $this->field->setOptions([
            'A' => 'Yes',
            'B' => 'No',
        ]);

        $this->assertEquals(
            [
                'A' => 'Yes',
                'B' => 'No',
            ],
            $this->field->options,
        );
    }
}
