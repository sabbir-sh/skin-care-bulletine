<?php

// app/Http/Requests/BlogPostRequest.php

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
        $postId = $this->route('id');

        return [
            'category_id'      => 'required|exists:categories,id',
            'title'            => 'required|string|max:255',
            // Slug is nullable. Unique check ignores current ID.
            'slug'             => 'nullable|string|max:255|unique:blog_posts,slug,' . $postId,
            'content'          => 'required|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:255',
            // Image is required on POST (create), but nullable on PATCH (update)
            'featured_image'   => ($this->isMethod('POST') ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'status'           => 'required|in:0,1',
        ];
    }
}
