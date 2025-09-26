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
                'autocomplete' => $this->field->autocomplete,
                'count' => $this->field->count,
                'displayName' => $this->field->displayName,
                'hint' => $this->field->hint,
                'id' => $this->field->id,
                'inputmode' => $this->field->inputmode,
                'isInline' => $this->field->isInline,
                'isTitle' => $this->field->isTitle,
                'label' => $this->field->label,
                'max' => $this->field->max,
                'min' => $this->field->min,
                'name' => $this->field->name,
                'noOptionsMessage' => $this->field->noOptionsMessage,
                'optional' => $this->field->optional,
                'optionalLabel' => $this->field->optionalLabel,
                'options' => $this->field->options,
                'placeholder' => $this->field->placeholder,
                'prefix' => $this->field->prefix,
                'rows' => $this->field->rows,
                'spellcheck' => $this->field->spellcheck,
                'step' => $this->field->step,
                'suffix' => $this->field->suffix,
                'threshold' => $this->field->threshold,
                'type' => $this->field->type->value,
                'value' => $this->field->value,
                'width' => $this->field->width,
                'words' => $this->field->words,
            ],
            $this->field->toArray(),
        );
    }
}
