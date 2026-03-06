<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;

class ModelHelper
{
    /** @param class-string<Form> $formClass */
    public static function loadModelFromDatabase(string $formClass, string $id): UsesForm
    {
        /** @var class-string<UsesForm> $modelClass */
        $modelClass = $formClass::modelClass();

        $model = new $modelClass();
        $key = $model->getRouteKeyName();

        /** @var UsesForm $model */
        $model = $modelClass::query()
            ->where($key, '=', $id)
            ->firstOrFail();

        return $model;
    }

    /** @param class-string<Form> $formClass */
    public static function newModel(string $formClass): UsesForm
    {
        /** @var class-string<UsesForm> $modelClass */
        $modelClass = $formClass::modelClass();

        return $modelClass::makeForForm();
    }
}
