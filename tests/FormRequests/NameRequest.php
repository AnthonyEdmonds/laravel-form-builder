<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class NameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'between:1,191',
            ],
        ];
    }
}
