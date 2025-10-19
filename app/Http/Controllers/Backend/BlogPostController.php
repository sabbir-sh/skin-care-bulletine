<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;

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
        return view('backend.blog_post.create');
    }

    public function store(BlogPostRequest $request)
    {
        $data = $request->validated();

        $this->blogService->create($data);

        return redirect()->route('blog.list')->with('success', 'Blog created successfully!');
    }
    

    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('backend.blog_post.create', compact('blog'));
    }

    public function update(BlogPostRequest $request, $id)
    {
        $blog = BlogPost::findOrFail($id);
        $data = $request->validated();

        $this->blogService->update($blog, $data);

        return redirect()->route('blog.list')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $this->blogService->delete($blog);

        return back()->with('success', 'Blog deleted successfully!');
    }
}
