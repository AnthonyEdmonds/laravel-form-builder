<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Utilities;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class AdditionalInputsTest extends TestCase
{
    /** @var Field[] */
    protected array $inputs;

    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My question?');

        $this->field->setOptions([
            'first' => [
                'inputs' => [
                    new Field('one', 'one'),
                    [
                        'name' => 'two',
                        'label' => 'two',
                        'value' => 'two',
                        'unknown' => 'blah',
                    ],
                ],
            ],
        ]);

        $this->inputs = $this->field->additionalInputs();
    }

    public function test(): void
    {
        $this->assertEquals(
            'one',
            $this->inputs[0]->name,
        );

        $this->assertEquals(
            'two',
            $this->inputs[1]->name,
        );
    }
}
