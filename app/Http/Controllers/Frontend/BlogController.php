<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    // Home page list
    public function index()
    {
        $data['blogs'] = BlogPost::where('status', 1) // Only published
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('frontend.blog.index', $data);
    }

    // Single blog page
    public function show($slug)
    {
        $data['blog'] = BlogPost::where('slug', $slug)->firstOrFail();

        return view('frontend.blog.show', $data);
    }
}
