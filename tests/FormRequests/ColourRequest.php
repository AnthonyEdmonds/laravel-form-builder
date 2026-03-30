<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class ColourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'colour' => [
                'required',
                'string',
            ],
        ];
    }
}
