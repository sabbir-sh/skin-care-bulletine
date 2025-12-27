<?php

namespace App\Http\Services\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogPostService
{
    /**
     * =========================
     * DataTable base query
     * =========================
     */
    public function getAllQuery()
    {
        return BlogPost::with('category')
            ->select('blog_posts.*')
            ->latest();
    }

    /**
     * =========================
     * Create
     * =========================
     */
    public function create(array $data)
    {
        $this->prepareSlug($data);

        if (!empty($data['featured_image'])) {
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        return BlogPost::create($data);
    }

    /**
     * =========================
     * Update
     * =========================
     */
    public function update(BlogPost $blog, array $data)
    {
        $this->prepareSlug($data);

        if (!empty($data['featured_image'])) {

            if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
                File::delete(public_path($blog->featured_image));
            }

            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        } else {
            unset($data['featured_image']);
        }

        $blog->update($data);
        return $blog;
    }

    /**
     * =========================
     * Delete
     * =========================
     */
    public function delete(BlogPost $blog)
    {
        if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
            File::delete(public_path($blog->featured_image));
        }

        return $blog->delete();
    }

    /**
     * =========================
     * Helpers
     * =========================
     */
    protected function prepareSlug(array &$data): void
    {
        if (!empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        } elseif (!empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
    }

    protected function uploadImage($image): string
    {
        $path = public_path('uploads/blog');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $name = time() . '_' . $image->getClientOriginalName();
        $image->move($path, $name);

        return 'uploads/blog/' . $name;
    }
}
