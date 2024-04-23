<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Container;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\ForkOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\ForkTwo;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionFive;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionFour;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionSix;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionThree;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionTwo;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TaskOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TaskTwo;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\TestForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\TestUser;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ItemStructureTest extends TestCase
{
    const array EXPECTED = [
        QuestionOne::class => QuestionOne::class,
        TaskOne::class => [
            QuestionTwo::class => QuestionTwo::class,
            ForkTwo::class => [
                QuestionFive::class => QuestionFive::class,
            ],
        ],
        ForkOne::class => [
            QuestionThree::class => QuestionThree::class,
            TaskTwo::class => [
                QuestionFour::class => QuestionFour::class,
            ],
        ],
        QuestionSix::class => QuestionSix::class,
    ];

    public function testGeneratesStructure(): void
    {
        $model = new TestUser();

        $this->assertEquals(self::EXPECTED, TestForm::itemStructure($model));
    }
}
