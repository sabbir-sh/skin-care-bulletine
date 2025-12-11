<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return response()->json([
            'status' => true,
            'total' => count($categories),
            'data' => $categories
        ]);
    }

    public function show($id)
    {
        $cat = Category::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $cat
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $this->categoryService->store($data);

            return response()->json([
                'status' => true,
                'message' => 'Category created successfully!'
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
            $this->categoryService->update($id, $request->all());

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully!'
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
        $this->categoryService->destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }
}
