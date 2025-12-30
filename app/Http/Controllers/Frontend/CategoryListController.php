<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\BlogPost;

class CategoryListController extends Controller
{
    public function show($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    // সব ক্যাটাগরি সাইডবারের জন্য
    $allCategories = Category::orderBy('name', 'asc')->get();

    // শুধুমাত্র এই ক্যাটাগরির পাবলিশড ব্লগগুলো
    // Pagination যোগ করা হয়েছে ভালো পারফরম্যান্সের জন্য
    $blogs = BlogPost::where('category_id', $category->id)
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->paginate(9); 

    return view('frontend.category.index', [
        'category' => $category,
        'blogs' => $blogs,
        'allCategories' => $allCategories,
    ]);
}
}
