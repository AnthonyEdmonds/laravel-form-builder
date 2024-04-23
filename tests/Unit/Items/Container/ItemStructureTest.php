<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Container;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TestQuestionOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\TestForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\TestUser;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ItemStructureTest extends TestCase
{
    const array EXPECTED = [
        TestQuestionOne::class => TestQuestionOne::class,
    ];

    public function testGeneratesStructure(): void
    {
        $model = new TestUser();

        $this->assertEquals(self::EXPECTED, TestForm::itemStructure($model));
    }
}
