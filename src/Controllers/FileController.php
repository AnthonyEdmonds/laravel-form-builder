<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    use AuthorizesRequests;

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

    public function download(
        string $formKey,
        string $modelKey,
        string $property,
        string $hash,
    ): StreamedResponse {
        /** @var class-string<Form> $formClass */
        $formClass = Form::classnameByKey($formKey);

        /** @var class-string<Model> $modelClass */
        $modelClass = $formClass::modelClass();
        $model = $modelClass::query()->findOrFail($modelKey);

        /** @var FileStore $fileStore */
        $fileStore = $model->$property;
        $permission = $fileStore->permission();

        if ($permission !== null) {
            $this->authorize($permission, $model);
        }

        return $fileStore->download($hash);
    }
}
