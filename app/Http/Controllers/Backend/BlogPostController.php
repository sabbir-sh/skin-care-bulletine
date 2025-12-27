<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogPostController extends Controller
{
    protected BlogPostService $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        return view('backend.blog_post.index');
    }

    /**
     * DataTable
     */
    public function getDataTable(Request $request)
    {
        return DataTables::of($this->blogService->getAllQuery())
            ->addIndexColumn()

            ->addColumn('featured_image', function ($blog) {
                return '<img src="'.$blog->featured_image_url.'" 
                        width="60" height="40"
                        class="rounded"
                        style="object-fit:cover;">';
            })

            ->addColumn('category', fn ($blog) =>
                $blog->category->name ?? 'N/A'
            )

            ->addColumn('status', fn ($blog) =>
                $blog->status
                    ? '<span class="badge bg-success-subtle text-success">Published</span>'
                    : '<span class="badge bg-secondary-subtle text-secondary">Draft</span>'
            )

            ->addColumn('actions', fn ($blog) => action_buttons([
                edit_column(route('blog.edit', $blog->id)),
                delete_column(route('blog.destroy', $blog->id)),
            ]))

            ->editColumn('created_at', fn ($blog) =>
                $blog->created_at->format('d M, Y')
            )

            ->rawColumns(['featured_image', 'status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('backend.blog_post.create', [
            'categories' => Category::where('status', 1)->get(),
            'authors'    => Author::orderBy('name')->get(),
        ]);
    }

    public function store(BlogPostRequest $request)
    {
        $this->blogService->create($request->validated());

        return redirect()
            ->route('blog.list')
            ->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        return view('backend.blog_post.create', [
            'blog'       => BlogPost::findOrFail($id),
            'categories' => Category::where('status', 1)->get(),
            'authors'    => Author::orderBy('name')->get(),
        ]);
    }

    public function update(BlogPostRequest $request, $id)
    {
        $blog = BlogPost::findOrFail($id);
        $this->blogService->update($blog, $request->validated());

        return redirect()
            ->route('blog.edit', $id)
            ->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $this->blogService->delete($blog);

        return back()->with('success', 'Blog deleted successfully!');
    }
}
