<?php

namespace AnthonyEdmonds\LaravelFormBuilder\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                new FileStoreUpload(),
            ],
        ];
    }
}

/*
 * TODO
 * FileStore Upload rule
 */
