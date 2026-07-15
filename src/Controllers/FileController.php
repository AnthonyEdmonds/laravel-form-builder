<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function show(
        string $formKey,
        string $taskKey,
        string $questionKey,
        string $property,
        string $hash,
    ): StreamedResponse {
        $form = Form::load($formKey)->checkAccess();

        return $form->model->$property->download($hash);
    }

    public function remove(
        string $formKey,
        string $taskKey,
        string $questionKey,
        string $property,
        string $hash,
    ): RedirectResponse {
        $form = Form::load($formKey)->checkAccess();

        $form->model->$property->remove($hash);
        Session::put($formKey, $form->model);

        return Redirect::to(
            $form->tasks()
                ->task($taskKey)
                ->question($questionKey)
                ->route(),
        );
    }
}
