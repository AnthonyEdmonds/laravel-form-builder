<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Enums\State;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ToBulmaClassTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(
        Colour $colour,
        string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $colour->toBulmaClass(),
        );
    }

    public static function expectations(): array
    {
        return [
            'blue' => [
                'colour' => Colour::Blue,
                'expected' => 'is-info is-light',
            ],
            'green' => [
                'colour' => Colour::Green,
                'expected' => 'is-success is-light',
            ],
            'grey' => [
                'colour' => Colour::Grey,
                'expected' => 'is-light',
            ],
            'light blue' => [
                'colour' => Colour::LightBlue,
                'expected' => 'is-info is-light',
            ],
            'red' => [
                'colour' => Colour::Red,
                'expected' => 'is-danger is-light',
            ],
            'yellow' => [
                'colour' => Colour::Yellow,
                'expected' => 'is-warning is-light',
            ],
        ];
    }
}
