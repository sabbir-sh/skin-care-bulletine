<?php

namespace App\Http\Services\Blood;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonorService
{
    public function query()
    {
        return Donor::with('bloodGroup')->select('donors.*');
    }

    public function find($id)
    {
        return Donor::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $this->prepareData($request);
        return Donor::create($data);
    }

    public function update($id, Request $request)
    {
        $donor = $this->find($id);
        $data = $this->prepareData($request, $donor);
        $donor->update($data);
        return $donor;
    }

    public function delete($id)
    {
        $donor = $this->find($id);

        if ($donor->image) {
            Storage::disk('public')->delete($donor->image);
        }

        return $donor->delete();
    }

    private function prepareData(Request $request, $donor = null)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($donor?->image) {
                Storage::disk('public')->delete($donor->image);
            }
            $data['image'] = $request->file('image')->store('donors', 'public');
        }

        $data['date_of_birth'] ??= null;
        $data['last_donation_date'] ??= null;

        return $data;
    }
}
