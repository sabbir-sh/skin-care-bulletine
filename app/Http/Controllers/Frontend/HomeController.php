<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\Donor;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private function getCommonData()
    {
        return [
            'bloodGroups' => BloodGroup::where('status', 1)
                ->withCount(['donors' => function ($q) {
                    $q->where('status', 1);
                }])->get(),
            'faqs' => Faq::where('status', 1)->take(10)->get(),
        ];
    }

    public function index()
    {
        $data = $this->getCommonData();
        $data['recentDonors'] = Donor::where('status', 1)->latest()->take(6)->get();
        $data['activeGroup'] = null;
        $data['title'] = "আমাদের বীর রক্তদাতারা";

        return view('frontend.home', $data);
    }

    public function bloodGroup($slug)
    {
        $bloodGroup = BloodGroup::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $data = $this->getCommonData();

        $data['recentDonors'] = Donor::where('status', 1)
            ->where('blood_group_id', $bloodGroup->id)
            ->latest()
            ->get();

        $data['activeGroup']   = $slug;
        $data['selectedGroup'] = $bloodGroup;
        $data['title']         = $bloodGroup->name . " গ্রুপের রক্তদাতা";

        $data['totalDonors']   = $data['recentDonors']->count();

        return view('frontend.blood_group_list', $data);
    }
}
