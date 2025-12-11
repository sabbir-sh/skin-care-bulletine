<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // --- Variables for your blog section ---
        
        // 1. Define a base height variable for layout consistency
        // Note: '500px' is not used in the final style, but kept for context.
        $base_height = '500px';

        // 2. Fetch the large, dominant featured blog post
        $dominantBlog = BlogPost::where('status', 1)
                                ->with('category') // Eager load the category
                                ->latest()
                                ->first(); // Get only one post

        // 3. Fetch the two stacked featured blog posts
        $stacked_blogs = BlogPost::where('status', 1)
                                ->when($dominantBlog, function ($query) use ($dominantBlog) {
                                    // Exclude the dominant blog from the stacked list
                                    return $query->where('id', '!=', $dominantBlog->id);
                                })
                                ->with('category') // Eager load the category
                                ->latest()
                                ->take(2) // Get exactly two posts
                                ->get();
        
        // --- Other data for the rest of your page ---

        // General list of all published blogs (using simple get for now)
        // If you need pagination, change ->get() to ->paginate(10)
        $data['blogs'] = BlogPost::where('status', 1) 
                                ->orderBy('created_at', 'desc')
                                ->get();

        // List of categories
        $data['categories']  = Category::where('status', 1)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        
        // --- Pass all required variables to the view ---
        
        $data['dominantBlog'] = $dominantBlog;
        $data['stacked_blogs'] = $stacked_blogs;
        $data['base_height'] = $base_height;

        return view('frontend.home', $data);
    }
}