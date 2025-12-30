<?php

namespace App\Http\Services\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostService
{
    public function getAllQuery()
    {
        return BlogPost::with(['category', 'author'])->latest();
    }

    public function create(array $data)
    {
        $this->prepareSlug($data);

        if (isset($data['featured_image'])) {
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        return BlogPost::create($data);
    }

    public function update(BlogPost $blog, array $data)
    {
        $this->prepareSlug($data);

        if (isset($data['featured_image'])) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        $blog->update($data);
        return $blog;
    }

    public function delete(BlogPost $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        return $blog->delete();
    }

    protected function prepareSlug(array &$data)
    {
        $data['slug'] = !empty($data['slug'])
            ? Str::slug($data['slug'])
            : Str::slug($data['title']);
    }

    protected function uploadImage($image): string
    {
        return $image->store('uploads/blog', 'public');
    }
}
