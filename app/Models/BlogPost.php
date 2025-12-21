<?php

// app/Models/BlogPost.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    // Added meta fields to fillable array
    protected $fillable = ['category_id','title','slug','content','featured_image','status', 'meta_title', 'meta_description', 'author_id', 'meta_keywords'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}