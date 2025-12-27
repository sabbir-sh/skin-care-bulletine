<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request; // ✅ MISSING IMPORT FIX
use Yajra\DataTables\Facades\DataTables;

class BlogPostController extends Controller
{
    protected BlogPostService $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * List page
     */
    public function index()
    {
        return view('backend.blog_post.index');
    }

    /**
     * DataTable data
     */
    public function getDataTable(Request $request)
    {
        return DataTables::of($this->blogService->getAllQuery()) // ✅ FIXED
            ->addIndexColumn()

            ->addColumn('featured_image', function ($blog) {
                if ($blog->featured_image) {
                    return '<img src="' . asset($blog->featured_image) . '" 
                                width="60" height="40"
                                style="object-fit:cover;"
                                class="rounded">';
                }
                return '<span class="text-muted">—</span>';
            })

            ->addColumn('category', function ($blog) {
                return $blog->category->name ?? 'N/A';
            })

            ->addColumn('status', function ($blog) {
                return $blog->status
                    ? '<span class="badge bg-success-subtle text-success px-3">Published</span>'
                    : '<span class="badge bg-secondary-subtle text-secondary px-3">Draft</span>';
            })

            ->addColumn('actions', fn($blog) => action_buttons([
                edit_column(route('blog.edit', $blog->id)),
                delete_column(route('blog.destroy', $blog->id)),
            ]))

            ->editColumn('created_at', function ($blog) {
                return $blog->created_at->format('d M, Y');
            })

            ->rawColumns(['featured_image', 'status', 'actions'])
            ->make(true);
    }

    /**
     * Create form
     */
    public function create()
    {
        return view('backend.blog_post.create', [
            'categories' => Category::where('status', 1)->get(),
            'authors'    => Author::orderBy('name')->get(),
        ]);
    }

    /**
     * Store
     */
    public function store(BlogPostRequest $request)
    {
        $this->blogService->create($request->validated());

        return redirect()
            ->route('blog.list')
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        return view('backend.blog_post.create', [
            'blog'       => BlogPost::findOrFail($id),
            'categories' => Category::where('status', 1)->get(),
            'authors'    => Author::orderBy('name')->get(),
        ]);
    }

    /**
     * Update
     */
    public function update(BlogPostRequest $request, $id)
    {
        $blog = BlogPost::findOrFail($id);

        $this->blogService->update($blog, $request->validated());

        return redirect()
            ->route('blog.edit', $id)
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete
     */
    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        $this->blogService->delete($blog);

        return back()->with('success', 'Blog deleted successfully!');
    }
}
