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
    public function __construct(protected DonorService $service) {}

    // ========= INDEX =========
    public function index()
    {
        return view('backend.donor.index');
    }

    public function getDataTable()
    {
        return DataTables::of($this->service->query())
            ->addIndexColumn()
            ->addColumn('image', function ($d) {
                $url = $d->image ? asset('storage/' . $d->image) : 'https://ui-avatars.com/api/?name=' . urlencode($d->name);
                return '<img src="' . $url . '" class="rounded-circle" width="40" height="40" style="object-fit: cover; border: 1px solid #ddd;">';
            })
            ->addColumn('blood_group', fn($d) => $d->bloodGroup->name ?? '')
            ->addColumn(
                'status',
                fn($d) =>
                $d->status
                    ? '<span class="badge bg-success">Approved</span>'
                    : '<span class="badge bg-warning">Pending</span>'
            )
            ->addColumn('actions', fn($d) => action_buttons([
                edit_column(route('donor.edit', $d->id)),
                delete_column(route('donor.destroy', $d->id)),
            ]))
            ->rawColumns(['image', 'status', 'actions']) // image এখানে যোগ করা হয়েছে
            ->make(true);
    }

    // ========= CREATE =========
    public function create()
    {
        return $this->form();
    }

    // ========= EDIT =========
    public function edit($id)
    {
        return $this->form($id);
    }

    private function form($id = null)
    {
        $editItem = $id ? $this->service->find($id) : null;

        $bloodGroups = BloodGroup::where('status', 1)->get();
        $districts = json_decode(Storage::disk('public')->get('bangladesh_districts.json'), true)['districts'] ?? [];
        $upazilas  = json_decode(Storage::disk('public')->get('bd-upazilas.json'), true)['upazilas'] ?? [];

        return view('backend.donor.create', compact(
            'editItem',
            'bloodGroups',
            'districts',
            'upazilas'
        ));
    }

    // ========= STORE =========
    public function store(DonorRequest $request)
    {
        $this->service->store($request);

        return redirect()
            ->route('donor.list')
            ->with('success', 'Donor added successfully');
    }

    // ========= UPDATE =========
    public function update(DonorRequest $request, $id)
    {
        $this->service->update($id, $request);

        return redirect()
            ->route('donor.list')
            ->with('success', 'Donor updated successfully');
    }

    // ========= DELETE =========
    public function destroy($id)
    {
        $this->service->delete($id);

        return back()->with('success', 'Donor deleted successfully');
    }
}
