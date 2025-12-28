<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonorRequest;
use App\Http\Services\Blood\DonorService;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DonorController extends Controller
{
    protected $service;

    public function __construct(DonorService $service)
    {
        $this->service = $service;
    }

    // ================= CREATE PAGE =================
    public function create()
    {
        $bloodGroups = BloodGroup::where('status', 1)->get();

        $districtsJson = json_decode(Storage::disk('public')->get('bangladesh_districts.json'), true);
        $districts = $districtsJson['districts'] ?? [];

        $upazilasJson = json_decode(Storage::disk('public')->get('bd-upazilas.json'), true);
        $upazilas = $upazilasJson['upazilas'] ?? [];

        $dhakaCityJson = json_decode(Storage::disk('public')->get('dhaka-city.json'), true);
        $dhakaCityAreas = $dhakaCityJson['areas'] ?? [];

        return view('backend.donor.create', compact('bloodGroups', 'districts', 'upazilas', 'dhakaCityAreas'));
    }

    // ================= INDEX WITH DATATABLE =================
    public function index()
    {
        return view('backend.donor.index'); // Datatable page, form not included
    }

    public function getDataTable(Request $request)
    {
        return DataTables::of($this->service->getAllQuery())
            ->addIndexColumn()
            ->addColumn('blood_group', fn($item) => $item->bloodGroup->name ?? '')
            ->addColumn('status', function ($item) {
                return $item->status
                    ? '<span class="badge bg-success">Approved</span>'
                    : '<span class="badge bg-danger">Pending</span>';
            })
            ->addColumn('actions', fn($item) => action_buttons([
                edit_column(route('donor.edit', $item->id)),
                delete_column(route('donor.destroy', $item->id)),
            ]))

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    // ================= STORE =================
    public function store(DonorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('donors', 'public');
        }

        if (empty($data['date_of_birth'])) $data['date_of_birth'] = null;

        $this->service->create($data);

        return redirect()->route('donor.list')->with('success', 'Donor added successfully');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $editItem = $this->service->find($id);

        $bloodGroups = BloodGroup::where('status', 1)->get();

        $districtsJson = json_decode(Storage::disk('public')->get('bangladesh_districts.json'), true);
        $districts = $districtsJson['districts'] ?? [];

        $upazilasJson = json_decode(Storage::disk('public')->get('bd-upazilas.json'), true);
        $upazilas = $upazilasJson['upazilas'] ?? [];

        $dhakaCityJson = json_decode(Storage::disk('public')->get('dhaka-city.json'), true);
        $dhakaCityAreas = $dhakaCityJson['areas'] ?? [];

        return view('backend.donor.create', compact('editItem', 'bloodGroups', 'districts', 'upazilas', 'dhakaCityAreas'));
    }

    // ================= UPDATE =================
    public function update(DonorRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('donors', 'public');
        }

        if (empty($data['date_of_birth'])) $data['date_of_birth'] = null;

        $this->service->update($id, $data);

        return redirect()->route('donor.list')->with('success', 'Donor updated successfully');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->back()->with('success', 'Donor deleted successfully');
    }
}
