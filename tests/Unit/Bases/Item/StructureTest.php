<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Bases\Item;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\ForkTwo;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionFive;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TaskOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\TestForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\TestUser;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class StructureTest extends TestCase
{
    public const array EXPECTED = [
        TaskOne::KEY,
        ForkTwo::KEY,
        QuestionFive::KEY,
    ];

    public function testReturnsPathToItem(): void
    {
        $model = new TestUser();
        $form = new TestForm($model);
        $item = $form->getItemAt(self::EXPECTED);

        $this->assertEquals(self::EXPECTED, $item->structure());

        dd($item->nextItem());
    }
}
