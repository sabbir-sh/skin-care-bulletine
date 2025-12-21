<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Hero slider blogs (featured)
        $data['heroBlogs'] = BlogPost::where('status', 1)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        // Single featured blog (fallback / other section)
        $data['featured'] = BlogPost::where('status', 1)
            ->with('category')
            ->latest()
            ->first();

        // Trending blogs
        $data['trending'] = BlogPost::where('status', 1)
            ->when($data['featured'], fn ($q) => $q->where('id', '!=', $data['featured']->id))
            ->latest()
            ->take(3)
            ->get();

        // Latest blogs (6 only)
        $data['blogs'] = BlogPost::where('status', 1)
            ->latest()
            ->take(6)
            ->get();

        // Categories
        $data['categories'] = Category::where('status', 1)->get();

        return view('frontend.home', $data );
    }
}
