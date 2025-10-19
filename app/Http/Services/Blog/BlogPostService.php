<?php

namespace App\Http\Services\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostService
{
    public function getAll()
    {
        return BlogPost::latest()->paginate(10);
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        if (isset($data['featured_image'])) {
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        return BlogPost::create($data);
    }

    public function update(BlogPost $blog, array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        if (isset($data['featured_image'])) {
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        $blog->update($data);
        return $blog;
    }

    public function delete(BlogPost $blog)
    {
        return $blog->delete();
    }

    private function uploadImage($image)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/blog'), $imageName);
        return 'uploads/blog/' . $imageName;
    }
}
