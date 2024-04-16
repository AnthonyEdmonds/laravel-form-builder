<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;

abstract class Form extends FormItem
{
    public static function getFormByKey(string $key): self
    {
        $registeredForms = config('form-builder.forms', []);

        foreach ($registeredForms as $form) {
            if ($form::key() === $key) {
                return new $form();
            }
        }

        throw new FormNotFoundException("The \"$key\" form has not been registered");
    }
}
