<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Blog\BlogPostService;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Exception;

class BlogPostApiController extends Controller
{
    protected $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->getAll();

        return response()->json([
            'status' => true,
            'total' => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'per_page' => $blogs->perPage(),
            'data' => $blogs->items()
        ]);
    }

    public function show($id)
    {
        $blog = BlogPost::with('category')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $blog = $this->blogService->create($data);

            return response()->json([
                'status' => true,
                'message' => 'Blog created successfully!',
                'data' => $blog
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = BlogPost::findOrFail($id);
            $updated = $this->blogService->update($blog, $request->all());

            return response()->json([
                'status' => true,
                'message' => 'Blog updated successfully!',
                'data' => $updated
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $this->blogService->delete($blog);

        return response()->json([
            'status' => true,
            'message' => 'Blog deleted successfully!'
        ]);
    }
}
