<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

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

        // Recent posts for sidebar
        $data['recentBlogs'] = BlogPost::latest()
            ->where('id', '!=', $data['blog']->id)
            ->take(5)
            ->get();

        // Similar posts: same category, excluding current blog
        $data['similarBlogs'] = BlogPost::where('category_id', $data['blog']->category_id)
            ->where('id', '!=', $data['blog']->id)
            ->latest()
            ->take(5)
            ->get();

        // Categories for sidebar
        $data['categories'] = Category::where('status', 1)->get();

        return view('frontend.blog.show', $data);
    }
    public function search(Request $request)
    {
        $query = $request->input('query'); // assign the input to $query

        $data['query'] = $query;

        $data['blogs'] = BlogPost::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data['categories'] = Category::where('status', 1)->get();

        return view('frontend.blog.search_results', $data);
    }

}
