<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormExpiredException;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class FormController
{
    public function start(string $formKey, ?string $modelKey = null): RedirectResponse
    {
        return Form::new($formKey, $modelKey)->start();
    }

    public function resume(string $formKey): View
    {
        return $this->getModel($formKey)->form()->resume();
    }

    public function begin(string $formKey): View
    {
        return $this->getModel($formKey)->form()->begin();
    }

    public function getItem(string $formKey, string $mode = Form::NEW, string $keys = ''): View
    {
        $model = $this->getModel($formKey);

        // TODO Load Item by Keys
        // TODO Return Item as it is renderable
    }

    public function saveItem(string $formKey, string $mode = Form::NEW, string $keys = ''): RedirectResponse
    {
        $model = $this->getModel($formKey);

        // TODO Load Item by Keys
        // TODO Save Item
    }

    public function skipItem(string $formKey, string $mode = Form::NEW, string $keys = ''): RedirectResponse
    {
        $model = $this->getModel($formKey);

        // TODO Load Item by Keys
        // TODO Skip Item
    }

    public function deleteItem(string $formKey, string $mode = Form::NEW, string $keys = ''): RedirectResponse
    {
        $model = $this->getModel($formKey);

        // TODO Load Item by Keys
        // TODO Delete Item
    }

    public function check(string $formKey): View
    {
        return $this->getModel($formKey)->form()->check();
    }
    
    public function save(string $formKey): RedirectResponse
    {
        return $this->getModel($formKey)->form()->save();
    }
    
    public function submit(string $formKey): RedirectResponse
    {
        return $this->getModel($formKey)->form()->submit();
    }
    
    public function finish(string $formKey): View
    {
        return $this->getModel($formKey)->form()->finish();
    }
    
    public function exit(string $formKey): RedirectResponse
    {
        return $this->getModel($formKey)->form()->exit();
    }

    // Utilities
    protected function getKeys(string $keys): array
    {
        return explode('.', $keys);
    }

    /** @return Model|HasForm */
    protected function getModel(string $formKey): Model
    {
        if (Session::has($formKey) !== true) {
            throw new FormExpiredException('The form you are trying to access has expired. Please start again.');
        }
        
        return Session::get($formKey);
    }
}
