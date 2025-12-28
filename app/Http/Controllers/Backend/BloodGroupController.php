<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodGroupRequest;
use App\Models\BloodGroup;
use Illuminate\Support\Str;

class BloodGroupController extends Controller
{
    public function index()
    {
        return view('backend.blood_group.index', [
            'bloodGroups' => BloodGroup::latest()->get(),
            'editItem'    => null,
        ]);
    }

    public function store(BloodGroupRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        BloodGroup::create($data);

        return redirect()->back()->with('success', 'Added successfully');
    }

    public function edit($id)
    {
        return view('backend.blood_group.index', [
            'bloodGroups' => BloodGroup::latest()->get(),
            'editItem'    => BloodGroup::findOrFail($id),
        ]);
    }

    public function update(BloodGroupRequest $request, $id)
    {
        $data = $request->validated();
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($data['name']);

        BloodGroup::findOrFail($id)->update($data);

        return redirect()->route('blood-group.list')->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        BloodGroup::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Blood group deleted successfully');
    }
}
