<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\BlogPost;

class CategoryListController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Only published blogs
        $blogs = BlogPost::where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.category.index', [
            'category' => $category,
            'blogs' => $blogs,
        ]);
    }
}
