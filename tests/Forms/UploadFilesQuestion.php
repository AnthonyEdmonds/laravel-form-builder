<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\Questions\UploadFiles;

/** @property MyForm $form */
class UploadFilesQuestion extends UploadFiles
{
    public static function key(): string
    {
        return 'upload-files';
    }

    public function displayName(): string
    {
        return 'Upload files';
    }

    public function fileStore(): FileStore
    {
        return $this->form->model->files;
    }

    public function filesRequired(): int
    {
        parent::filesRequired();

        return 1;
    }
}
