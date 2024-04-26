<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Exceptions;

use Exception;
use Throwable;

class ItemNotFoundException extends Exception
{
    public function __construct(string $key = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("An Item with the key \"$key\" does not exist in this Container", $code, $previous);
    }
}
