<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemController
{
    /** Show a Form Item at the given path */
    public function show(string $formKey, string $path): View
    {
        return Form::getModelFromSession($formKey)
            ->setCurrentPath($path)
            ->form()
            ->getItem($path);
    }

    /** Validate and save the answer to a given Question */
    public function save(Request $request, string $formKey, string $path): RedirectResponse
    {
        $item = Form::getModelFromSession($formKey)
            ->form()
            ->getItem($path);

        if (is_a($item, Question::class) === true) {
            $item->validate();
            $item->save($request);
            $item->form->putModelIntoSession();

            if ($item::LOOPING === true) {
                return back();
            }
        }

        return redirect($item->nextRoute());
    }

    /** Skip a given Question */
    public function skip(string $formKey, string $path): RedirectResponse
    {
        $item = Form::getModelFromSession($formKey)
            ->form()
            ->getItem($path);
        
        if (is_a($item, Question::class) === true) {
            if ($item::CAN_SKIP === true) {
                $item->skip();
                $item->form->putModelIntoSession();
            }
        }
        
        return redirect($item->nextRoute());
    }
}
