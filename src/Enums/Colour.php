<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Enums;

enum Colour: string
{
    case Blue = 'blue';

    case Green = 'green';

    case Grey = 'grey';

    case LightBlue = 'light-blue';

    case Red = 'red';

    case Yellow = 'yellow';

    public function toBulmaClass(): string
    {
        return match ($this) {
            self::Blue => "is-info is-light",
            self::Green => "is-success is-light",
            self::Grey => "is-light",
            self::LightBlue => "is-info is-light",
            self::Red => "is-danger is-light",
            self::Yellow => "is-warning is-light",
        };
    }
}
