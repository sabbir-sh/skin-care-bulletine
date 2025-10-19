<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data['categories'] = $this->categoryService->getAll();
        return view('backend.category.index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->categoryService->getAll();
        return view('backend.category.index', $data);
    }

    public function store(CategoryRequest $request)
    {
        if ($this->categoryService->store($request->validated())) {
            return redirect()->route('category.list')->with('success', 'Category created successfully.');
        }
        return back()->with('error', 'Failed to create category.');
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryService->findById($id);
        $data['categories'] = $this->categoryService->getAll();
        return view('backend.category.index', $data);
    }

    public function update(CategoryRequest $request, $id)
    {
        if ($this->categoryService->update($id, $request->validated())) {
            return redirect()->route('category.list')->with('success', 'Category updated successfully.');
        }
        return back()->with('error', 'Failed to update category.');
    }

    public function destroy($id)
    {
        if ($this->categoryService->destroy($id)) {
            return redirect()->route('category.list')->with('success', 'Category deleted successfully.');
        }
        return back()->with('error', 'Failed to delete category.');
    }
}
