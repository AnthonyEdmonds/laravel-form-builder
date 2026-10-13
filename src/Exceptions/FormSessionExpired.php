<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Exceptions;

use ErrorException;

class FormSessionExpired extends ErrorException
{
    public function report(): null
    {
        return null;
    }
}
