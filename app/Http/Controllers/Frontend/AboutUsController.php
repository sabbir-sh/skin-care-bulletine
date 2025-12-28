<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
{
    $data['totalDonors'] = Donor::count(); 

    return view('frontend.about_us.index', $data); 
}
}
