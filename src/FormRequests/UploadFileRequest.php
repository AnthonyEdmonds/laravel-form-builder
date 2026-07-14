<?php

namespace AnthonyEdmonds\LaravelFormBuilder\FormRequests;

use AnthonyEdmonds\LaravelFileStore\AllowedInFileStore;
use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property UsesForm $model
 * @property FileStore $fileStore
 */
class UploadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                new AllowedInFileStore($this->fileStore),
            ],
        ];
    }
}
