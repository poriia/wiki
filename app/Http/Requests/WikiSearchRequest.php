<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WikiSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'required|string|min:3',
        ];
    }
}
