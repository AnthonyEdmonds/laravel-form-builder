<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Field\Setters;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SetWordsTest extends TestCase
{
    protected Field $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = new Field('my-name', 'My label');
        $this->field->setWords(10);
    }

    public function test(): void
    {
        $this->assertEquals(
            10,
            $this->field->words,
        );
    }
}
