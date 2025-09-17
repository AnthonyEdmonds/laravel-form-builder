<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class AgeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'age' => [
                'nullable',
                'integer',
                'between:1,99',
            ],
        ];
    }
}
