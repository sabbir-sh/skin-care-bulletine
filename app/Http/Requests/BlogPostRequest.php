<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $this->route('id'),
        'content' => 'required|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'meta_keywords' => 'nullable|string|max:255',
        'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:0,1',
    ];
    }

}
