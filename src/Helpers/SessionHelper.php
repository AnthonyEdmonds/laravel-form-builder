<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormSessionExpired;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Support\Facades\Session;

class SessionHelper
{
    public static function clearFormSession(string $formKey): void
    {
        Session::forget($formKey);
    }

    public static function formHasSession(string $formKey): bool
    {
        return Session::has($formKey);
    }

    public static function getFormSession(string $formKey): UsesForm
    {
        return self::formHasSession($formKey) === true
            ? Session::get($formKey)
            : throw new FormSessionExpired('Your form session has expired; either edit a record or start fresh');
    }

    public static function modelHasSession(string $formKey, string $modelKey): bool
    {
        if (self::formHasSession($formKey) === false) {
            return false;
        }

        $model = self::getFormSession($formKey);

        return (string) $model->getKey() === $modelKey;
    }

    public static function setFormSession(string $formKey, UsesForm $model): void
    {
        Session::put($formKey, $model);
    }
}
