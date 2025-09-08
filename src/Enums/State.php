<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Enums;

/**
 * Cannot start yet   | Something else must be done first
 * Completed          | User has finished
 * In progress        | User has answered some questions
 * Incomplete         | User has answered some questions
 * Not required       | User does not need to complete this task
 * Not yet started    | User has not started answering
 * There is a problem | An answer is in error, perhaps due to a change in another Task
 * Unknown            | Could not determine the current status
 */
enum State: string
{
    case CannotStartYet = 'Cannot start yet';

    case Completed = 'Completed';

    case InProgress = 'In progress';

    case Incomplete = 'Incomplete';

    case NotRequired = 'Not required';

    case NotYetStarted = 'Not yet started';

    case ThereIsAProblem = 'There is a problem';

    case Unknown = 'Unknown';

    public function colour(): Colour
    {
        return match ($this) {
            self::Completed => Colour::Green,
            self::InProgress => Colour::LightBlue,
            self::Incomplete => Colour::Yellow,
            self::NotYetStarted => Colour::Blue,
            self::ThereIsAProblem => Colour::Red,
            default => Colour::Grey,
        };
    }
}
