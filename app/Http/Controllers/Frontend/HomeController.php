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

    public function index(Request $request)
    {
        $data = $this->getCommonData();

        // search query start
        $query = Donor::with('bloodGroup')->where('status', 1);

        // filter
        if ($request->filled('district')) {
            $query->where('district', 'like', '%' . $request->district . '%');
        }
        if ($request->filled('upazila')) {
            $query->where('upazila', 'like', '%' . $request->upazila . '%');
        }
        if ($request->filled('union')) {
            $query->where('union', 'like', '%' . $request->union . '%');
        }
        if ($request->filled('village')) {
            $query->where('village', 'like', '%' . $request->village . '%');
        }

        // if no search then show oldest 9 donors, otherwise show search results
        $data['recentDonors'] = $query->oldest()->take(9)->get();

        $data['total_donors'] = Donor::where('status', 1)->count();
        $data['available_donors'] = Donor::where('status', 1)->where('is_available', 1)->count();
        $data['total_groups'] = BloodGroup::where('status', 1)->count();

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
        $data['bloodGroups'] = BloodGroup::where('status', 1)->get();

        return view('frontend.blood_group_list', $data);
    }
}
