<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Author;

class BlogPostController extends Controller
{
    protected $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->getAll();
        return view('backend.blog_post.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $authors    = Author::orderBy('name')->get();

        return view('backend.blog_post.create', compact('categories', 'authors'));
    }

    public function store(BlogPostRequest $request)
    {
        $this->blogService->create($request->validated());

        return redirect()
            ->route('blog.list')
            ->with('success', 'Blog created successfully! 🎉');
    }

    public function edit($id)
    {
        $blog       = BlogPost::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $authors    = Author::orderBy('name')->get();

        return view('backend.blog_post.create', compact(
            'blog',
            'categories',
            'authors'
        ));
    }

    public function update(BlogPostRequest $request, $id)
    {
        $blog = BlogPost::findOrFail($id);

        $this->blogService->update($blog, $request->validated());

        return redirect()
            ->route('blog.edit', $id)
            ->with('success', 'Blog updated successfully! ✏️');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        $this->blogService->delete($blog);

        return back()
            ->with('success', 'Blog deleted successfully! 🗑️');
    }
}
