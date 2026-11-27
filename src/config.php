<?php

return [
    /**
     * Which Forms have been registered
     */
    'forms' => [
        // MyForm::class,
    ],

    /**
     * Optional parent layout used by the Bulma templates.
     *
     * name: Blade view to extend.
     * section: Layout section to render content into.
     */
    'layout' => [
        'name' => null,
        'section' => null,
    ],

    /**
     * Which templates to serve, currently supports:
     * default
     * bootstrap
     * bulma
     * govuk
     */
    'template' => 'default',
];
