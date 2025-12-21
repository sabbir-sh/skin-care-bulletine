<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'bio'      => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter'  => 'nullable|url',
            'linkedin' => 'nullable|url',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        return $rules;
    }
}
