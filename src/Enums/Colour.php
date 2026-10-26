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
            self::Blue => "is-info",
            self::Green => "is-success",
            self::Grey => "is-light",
            self::LightBlue => "is-info is-light",
            self::Red => "is-danger",
            self::Yellow => "is-warning",
        };
    }
}
