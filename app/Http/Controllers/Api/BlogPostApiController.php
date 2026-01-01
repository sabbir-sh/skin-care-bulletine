<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Blog\BlogPostService;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use Exception;

class BlogPostApiController extends Controller
{
    protected $blogService;

    public function __construct(BlogPostService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Blog list with pagination
     */
    public function index()
    {
        $blogs = $this->blogService
            ->getAllQuery()
            ->paginate(10);

        return response()->json([
            'status' => true,
            'total' => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'per_page' => $blogs->perPage(),
            'data' => $blogs->items(),
        ]);
    }

    /**
     * Single blog details
     */
    public function show($id)
    {
        $blog = BlogPost::with(['category', 'author'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    /**
     * Store new blog
     */
    public function store(BlogPostRequest $request)
    {
        try {
            $blog = $this->blogService->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Blog created successfully!',
                'data' => $blog
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Update blog
     */
    public function update(BlogPostRequest $request, $id)
    {
        try {
            $blog = BlogPost::findOrFail($id);
            $updatedBlog = $this->blogService->update($blog, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Blog updated successfully!',
                'data' => $updatedBlog
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Delete blog
     */
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
