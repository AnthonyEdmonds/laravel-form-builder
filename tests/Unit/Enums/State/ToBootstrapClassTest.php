<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Enums\State;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ToBootstrapClassTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(
        Colour $colour,
        string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $colour->toBootstrapClass(),
        );
    }

    public static function expectations(): array
    {
        return [
            'blue' => [
                'colour' => Colour::Blue,
                'expected' => 'badge-info text-white',
            ],
            'green' => [
                'colour' => Colour::Green,
                'expected' => 'badge-success text-white',
            ],
            'grey' => [
                'colour' => Colour::Grey,
                'expected' => 'badge-secondary text-white',
            ],
            'light blue' => [
                'colour' => Colour::LightBlue,
                'expected' => 'badge-info text-white',
            ],
            'red' => [
                'colour' => Colour::Red,
                'expected' => 'badge-danger text-white',
            ],
            'yellow' => [
                'colour' => Colour::Yellow,
                'expected' => 'badge-warning text-white',
            ],
        ];
    }
}
