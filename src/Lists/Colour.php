<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Lists;

/**
 * Not required       | User does not need to complete this task
 * Cannot start yet   | Something else must be done first
 * Incomplete         | User has answered some questions
 * Not yet started    | User has not started answering
 * In progress        | User has answered some questions
 * There is a problem | An answer is in error, perhaps due to a change in another Task
 * Completed          | User has finished
 */
class Colour
{
    public const string BLUE = 'blue';

    public const string GREEN = 'green';

    public const string GREY = 'grey';

    public const string LIGHT_BLUE = 'light-blue';

    public const string RED = 'red';

    public const string YELLOW = 'yellow';

    public const array COLOURS = [
        self::BLUE,
        self::GREEN,
        self::GREY,
        self::LIGHT_BLUE,
        self::RED,
        self::YELLOW,
    ];
}
