<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FormController
{
    /** Start or resume a new Form session; everything starts here! */
    public function start(string $formKey, ?string $modelKey = null): RedirectResponse
    {
        return $this->newForm($formKey, 'start', $modelKey)->start();
    }

    /** Ask the User whether they want to resume their Form session */
    public function resume(string $formKey): View
    {
        return $this->loadForm($formKey, 'resume')->resume();
    }

    /** Force a fresh Form session */
    public function fresh(string $formKey, ?string $modelKey = null): RedirectResponse
    {
        return $this->newForm($formKey, 'fresh', $modelKey)->fresh();
    }

    /** Give the User some information before they start, if set */
    public function begin(string $formKey): View|RedirectResponse
    {
        return $this->loadForm($formKey, 'begin')->begin();
    }

    /** Allow the User to check their answers, if set */
    public function check(string $formKey): View|RedirectResponse
    {
        return $this->loadForm($formKey, 'check')->check();
    }

    /** Save the Form session without submitting */
    public function save(string $formKey): RedirectResponse
    {
        return $this->loadForm($formKey, 'save')->save();
    }

    /** Submit the Form session */
    public function submit(string $formKey): RedirectResponse
    {
        return $this->loadForm($formKey, 'submit')->submit();
    }

    /** Give the User confirmation of submission, if set */
    public function finish(string $formKey): View|RedirectResponse
    {
        $this->loadForm($formKey, 'finish')->finish();
    }

    /** Make a new Form session */
    protected function newForm(string $formKey, string $path, ?string $modelKey = null): Form
    {
        return Form::new($formKey, $modelKey)
            ->model
            ->setCurrentPath($path)
            ->form();
    }

    /** Get the current Form session */
    protected function loadForm(string $formKey, string $path): Form
    {
        return Form::getModelFromSession($formKey)
            ->setCurrentPath($path)
            ->form();
    }
}
