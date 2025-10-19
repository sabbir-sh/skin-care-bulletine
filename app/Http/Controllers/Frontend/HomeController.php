<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['blogs'] = BlogPost::orderBy('created_at', 'desc')->get();
        return view('frontend.home', $data);
    }
}
