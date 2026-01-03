<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonorRequest;
use App\Models\BloodGroup;
use App\Models\Donor;

class DonorRegistationController extends Controller
{
    public function index()
    {
        $data['bloodGroups'] = BloodGroup::where('status', 1)->get();
        return view('frontend.donor.register', $data);
    }

    public function submit(DonorRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 0;
        $data['is_available'] = 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('donors', 'public');
        }

        Donor::create($data);

        return redirect()->back()
            ->with('success', 'রেজিস্ট্রেশন সফল হয়েছে! আপনার দয়ালু উদ্যোগের জন্য ধন্যবাদ। অ্যাডমিন অনুমোদনের পর আপনার ডোনার প্রোফাইল প্রকাশ করা হবে।');
    }
}
