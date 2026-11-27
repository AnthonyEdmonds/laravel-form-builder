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
                'expected' => 'alert-info',
            ],
            'green' => [
                'colour' => Colour::Green,
                'expected' => 'alert-success',
            ],
            'grey' => [
                'colour' => Colour::Grey,
                'expected' => 'alert-secondary',
            ],
            'light blue' => [
                'colour' => Colour::LightBlue,
                'expected' => 'alert-info',
            ],
            'red' => [
                'colour' => Colour::Red,
                'expected' => 'alert-danger',
            ],
            'yellow' => [
                'colour' => Colour::Yellow,
                'expected' => 'alert-warning',
            ],
        ];
    }
}
