<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['blogs'] = BlogPost::where('status', 1) // published
                                ->orderBy('created_at', 'desc')
                                ->get();

        $data['categories']  = Category::where('status', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
                                                  
        return view('frontend.home', $data);
    }
}
