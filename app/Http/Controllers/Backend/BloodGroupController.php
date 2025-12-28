<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodGroupRequest;
use App\Models\BloodGroup;

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
        BloodGroup::create($request->validated());

        return redirect()->back()->with('success', 'Blood group added successfully');
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
        BloodGroup::findOrFail($id)->update($request->validated());

        return redirect()
            ->route('blood-group.list')
            ->with('success', 'Blood group updated successfully');
    }

    public function destroy($id)
    {
        BloodGroup::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Blood group deleted successfully');
    }
}
