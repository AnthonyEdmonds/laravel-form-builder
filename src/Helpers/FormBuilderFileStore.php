<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFileStore\FileStore;

class FormBuilderFileStore extends FileStore
{
    public function downloadRoute(string $hash, array $routeParameters = []): string
    {
        return route('forms.task.questions.files.show', [
            $routeParameters['form'],
            $routeParameters['task'],
            $routeParameters['question'],
            $this->property,
            $hash,
        ]);
    }

    public function removeRoute(string $hash, array $routeParameters = []): string
    {
        return route('forms.task.questions.files.remove', [
            $routeParameters['form'],
            $routeParameters['task'],
            $routeParameters['question'],
            $this->property,
            $hash,
        ]);
    }
}
