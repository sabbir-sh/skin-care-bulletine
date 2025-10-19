<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total = BlogPost::count();
        $published = BlogPost::where('status', 1)->count();
        $draft = BlogPost::where('status', 0)->count();

        return view('backend.dashboard', compact('total', 'published', 'draft'));
    }
}
