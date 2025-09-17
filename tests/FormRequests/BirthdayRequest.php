<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class BirthdayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'birthday' => [
                'required',
                'date',
                'after:2000-01-01 00:00:00',
            ],
        ];
    }
}
