<?php

namespace App\Http\Services\Blood;

use App\Models\Donor;

class DonorService
{
    public function getAllQuery()
    {
        return Donor::with('bloodGroup')->select('donors.*');
    }

    public function create(array $data)
    {
        return Donor::create($data);
    }

    public function find($id)
    {
        return Donor::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $donor = $this->find($id);
        $donor->update($data);
        return $donor;
    }

    public function delete($id)
    {
        $donor = $this->find($id);
        return $donor->delete();
    }
}
