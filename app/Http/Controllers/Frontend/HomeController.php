<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost; // Make sure this model is correctly named BlogPost
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // --- Variables for your blog section ---
        
        // 1. Define a base height variable for layout consistency
        $base_height = '500px';

        // 2. Fetch the large, dominant featured blog post
        // We'll use the latest published post as the dominant one for this example.
        // You might want to add a specific 'is_dominant' column later for more control.
        $dominantBlog = BlogPost::where('status', 1)
                                  ->with('category') // Eager load the category
                                  ->latest()
                                  ->first(); // Get only one post

        // 3. Fetch the two stacked featured blog posts
        // We'll skip the dominant one by excluding its ID (if it exists) and take the next two.
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

        // General list of all published blogs (already in your original code)
        $data['blogs'] = BlogPost::where('status', 1) 
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        // List of categories (already in your original code)
        $data['categories']  = Category::where('status', 1)
                                       ->orderBy('created_at', 'desc')
                                       ->get();
        
        // --- Pass all required variables to the view ---
        
        // Add the new variables to the $data array
        $data['dominantBlog'] = $dominantBlog;
        $data['stacked_blogs'] = $stacked_blogs;
        $data['base_height'] = $base_height; // This variable is required for your inline styles

        return view('frontend.home', $data);
    }
}