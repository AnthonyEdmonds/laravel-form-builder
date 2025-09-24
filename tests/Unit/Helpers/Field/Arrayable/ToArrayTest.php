<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Arrayable;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ToArrayTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Field::checkboxes(
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
                'accept' => $this->field->accept,
                'hint' => $this->field->hint,
                'id' => $this->field->id,
                'isTitle' => $this->field->isTitle,
                'label' => $this->field->label,
                'max' => $this->field->max,
                'min' => $this->field->min,
                'name' => $this->field->name,
                'noOptionsMessage' => $this->field->noOptionsMessage,
                'optional' => $this->field->optional,
                'optionalLabel' => $this->field->optionalLabel,
                'options' => $this->field->options,
                'question' => $this->field->question,
                'step' => $this->field->step,
                'type' => $this->field->type->value,
                'value' => $this->field->value,
            ],
            $this->field->toArray(),
        );
    }
}
