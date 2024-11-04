<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Lists;

/**
 * Cannot start yet   | Something else must be done first
 * Completed          | User has finished
 * In progress        | User has answered some questions
 * Incomplete         | User has answered some questions
 * Not required       | User does not need to complete this task
 * Not yet started    | User has not started answering
 * There is a problem | An answer is in error, perhaps due to a change in another Task
 */
class Status
{
    public const string CANNOT_START_YET = 'Cannot start yet';

    public const string COMPLETED = 'Completed';

    public const string IN_PROGRESS = 'In progress';

    public const string INCOMPLETE = 'Incomplete';

    public const string NOT_REQUIRED = 'Not required';

    public const string NOT_YET_STARTED = 'Not yet started';

    public const string THERE_IS_A_PROBLEM = 'There is a problem';

    public const array STATUSES = [
        self::CANNOT_START_YET,
        self::COMPLETED,
        self::IN_PROGRESS,
        self::INCOMPLETE,
        self::NOT_REQUIRED,
        self::NOT_YET_STARTED,
        self::THERE_IS_A_PROBLEM,
    ];

    public const array COLOUR = [
        self::CANNOT_START_YET => Colour::GREY,
        self::COMPLETED => Colour::GREEN,
        self::IN_PROGRESS => Colour::LIGHT_BLUE,
        self::INCOMPLETE => Colour::YELLOW,
        self::NOT_REQUIRED => Colour::GREY,
        self::NOT_YET_STARTED => Colour::BLUE,
        self::THERE_IS_A_PROBLEM => Colour::RED,
    ];
}
