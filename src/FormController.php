<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormExpiredException;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class FormController
{
    public function get(string $formKey, string $mode = Form::NEW, string $keys = ''): View
    {
        $subject = $this->getSubject($formKey);

        // TODO Determine what to do based on item type
    }

    public function post(string $formKey, string $mode = Form::NEW, string $keys = ''): View
    {
        $subject = $this->getSubject($formKey);

        // TODO Determine what to do based on item type
    }

    public function delete(string $formKey, string $mode = Form::NEW, string $keys = ''): View
    {
        $subject = $this->getSubject($formKey);

        // TODO Determine what to do based on item type
    }

    protected function getKeys(string $keys): array
    {
        return explode('.', $keys);
    }

    protected function getSubject(string $formKey): Model
    {
        if (Session::has($formKey) !== true) {
            throw new FormExpiredException('The form you are trying to access has expired. Please start again.');
        }

        return Session::get($formKey);
    }
}
