<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WikiStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:5',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
