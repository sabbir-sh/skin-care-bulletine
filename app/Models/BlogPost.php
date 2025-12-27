<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'meta_title',
        'meta_description',
        'author_id',
        'meta_keywords'
    ];

    /* ===============================
     | Featured Image URL Accessor
     ===============================*/
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image && file_exists(public_path($this->featured_image))) {
            return asset($this->featured_image);
        }

        return asset('images/default-blog.jpg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
