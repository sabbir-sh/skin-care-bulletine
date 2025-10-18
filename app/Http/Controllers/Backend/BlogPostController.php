<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::latest()->paginate(10);
        return view('backend.blog_post.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog'), $imageName);
            $data['featured_image'] = 'uploads/blog/' . $imageName;
        }

        BlogPost::create($data);

        return redirect()->route('admin.blogList')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('backend.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $blog = BlogPost::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog'), $imageName);
            $data['featured_image'] = 'uploads/blog/' . $imageName;
        }

        $blog->update($data);

        return redirect()->route('admin.blogList')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }
}
