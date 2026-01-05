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
            'site_name'        => 'nullable|string|max:255',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon'          => 'nullable|image|mimes:ico,png,jpg|max:1024',
            'logo_remove'      => 'nullable|string', // Hidden field for JS
            'favicon_remove'   => 'nullable|string', // Hidden field for JS
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'facebook'         => 'nullable|url',
            'twitter'          => 'nullable|url',
            'youtube'          => 'nullable|url',
            'homepage_layout'  => 'required|in:default,blog',
        ];
    }

}
