<?php

// app/Http/Controllers/Backend/BlogPostController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;
use App\Models\Category;

class BlogPostController extends Controller
{
    protected $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $data['blogs'] = $this->blogService->getAll();
        return view('backend.blog_post.index', $data);
    }

    public function create()
    {
        // Eager load categories for efficiency
        $categories = Category::where('status', 1)->get();
        return view('backend.blog_post.create', compact('categories'));
    }

    public function store(BlogPostRequest $request)
    {
        $data = $request->validated();
        $this->blogService->create($data);

        return redirect()->route('blog.list')->with('success', 'Blog created successfully! 🎉');
    }

    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('backend.blog_post.create', compact('blog', 'categories'));
    }

    public function update(BlogPostRequest $request, $id)
    {
        $blog = BlogPost::findOrFail($id);
        $data = $request->validated();

        $this->blogService->update($blog, $data);

        return redirect()->route('blog.list')->with('success', 'Blog updated successfully! ✏️');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $this->blogService->delete($blog);

        return back()->with('success', 'Blog deleted successfully! 🗑️');
    }
}