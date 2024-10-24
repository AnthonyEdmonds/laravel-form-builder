<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Enums;

/**
 * Cannot start yet   | Something else must be done first
 * Incomplete         | User has answered some questions
 * Not yet started    | User has not started answering
 * In progress        | User has answered some questions
 * There is a problem | An answer is in error, perhaps due to a change in another Task
 * Completed          | User has finished
 */
enum Status: string
{
    case CannotStartYet = 'grey';
    case NotYetStarted = 'blue';
    case InProgress = 'light-blue';
    case Incomplete = 'yellow';
    case ThereIsAProblem = 'red';
    case Completed = 'green';
}
