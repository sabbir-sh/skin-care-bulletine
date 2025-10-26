<?php

// app/Http/Services/Blog/BlogPostService.php

namespace App\Http\Services\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Required for file operations

class BlogPostService
{
    public function getAll()
    {
        // Eager load category relationship for better performance on the index page
        return BlogPost::with('category')->latest()->paginate(10); 
    }

    /**
     * Helper to upload the image and return the path.
     */
    private function uploadImage($image)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        // Use a standard storage path for safety
        $image->move(public_path('uploads/blog'), $imageName);
        return 'uploads/blog/' . $imageName;
    }

    /**
     * Helper to generate or use the slug from the input data.
     */
    protected function generateOrUseSlug(array &$data): void
    {
        // 1. If slug is provided and not empty, use it (and slugify it).
        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        } 
        // 2. Otherwise, generate slug from title.
        elseif (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
    }

    public function create(array $data)
    {
        $this->generateOrUseSlug($data); 

        if (isset($data['featured_image'])) {
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }

        return BlogPost::create($data);
    }

    public function update(BlogPost $blog, array $data)
    {
        $this->generateOrUseSlug($data);

        if (isset($data['featured_image'])) {
            // Delete old image if it exists
            if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
                File::delete(public_path($blog->featured_image));
            }
            $data['featured_image'] = $this->uploadImage($data['featured_image']);
        }
        
        // If image is not set in $data, the old one remains.

        $blog->update($data);
        return $blog;
    }

    public function delete(BlogPost $blog)
    {
        // Delete the featured image before deleting the record
        if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
            File::delete(public_path($blog->featured_image));
        }

        return $blog->delete();
    }
}