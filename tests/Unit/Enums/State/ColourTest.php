<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Enums\State;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ColourTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(State $state, Colour $colour): void
    {
        $this->assertEquals(
            $colour,
            $state->colour(),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'state' => State::Completed,
                'colour' => Colour::Green,
            ],
            [
                'state' => State::InProgress,
                'colour' => Colour::LightBlue,
            ],
            [
                'state' => State::Incomplete,
                'colour' => Colour::Yellow,
            ],
            [
                'state' => State::NotYetStarted,
                'colour' => Colour::Blue,
            ],
            [
                'state' => State::ThereIsAProblem,
                'colour' => Colour::Red,
            ],
            [
                'state' => State::CannotStartYet,
                'colour' => Colour::Grey,
            ],
        ];
    }
}
