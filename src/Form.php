<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Bases\FormItem;
use Anthonyedmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

abstract class Form extends FormItem
{
    public const string EDIT = 'edit';

    public const string NEW = 'new';

    public const string REVIEW = 'review';

    public const array MODES = [
        self::EDIT,
        self::NEW,
        self::REVIEW,
    ];

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

    // Routing
    public function start(): RedirectResponse
    {
        Session::put(static::KEY, $this->subject);

        $route = $this->subject->exists === true
            ? $this->routes()['summary']
            : $this->routes()['start'];

        return redirect($route);
    }

    protected function exitRoute(): string
    {
        return route('dashboard');
    }
}
