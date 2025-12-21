<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name'        => 'required|string|max:255',

            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon'          => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',

            'facebook'         => 'nullable|url',
            'twitter'          => 'nullable|url',
            'youtube'          => 'nullable|url',

            'homepage_layout'  => 'required|in:default,blog',
        ];
    }

    public function messages(): array
    {
        return [
            'site_name.required' => 'Site name is required',
            'logo.image'         => 'Logo must be an image file',
            'favicon.image'      => 'Favicon must be an image file',
            'facebook.url'       => 'Facebook link must be a valid URL',
        ];
    }
}
