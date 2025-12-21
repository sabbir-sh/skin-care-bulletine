<?php

namespace App\Http\Services\Faq;

use App\Models\Faq;
use Illuminate\Support\Facades\Storage;

class FaqService
{
    // Create FAQ
    public function create(array $data)
    {
        if (!empty($data['image'])) {
            $data['image'] = $data['image']->store('faq', 'public');
        }

        return Faq::create($data);
    }

    // Update FAQ
    public function update(Faq $faq, array $data)
    {
        if (!empty($data['image'])) {
            // Delete old image if exists
            if ($faq->image && Storage::disk('public')->exists($faq->image)) {
                Storage::disk('public')->delete($faq->image);
            }

            $data['image'] = $data['image']->store('faq', 'public');
        } else {
            unset($data['image']);
        }

        $faq->update($data);

        return $faq;
    }

    // Delete FAQ
    public function delete(Faq $faq)
    {
        if ($faq->image && Storage::disk('public')->exists($faq->image)) {
            Storage::disk('public')->delete($faq->image);
        }

        return $faq->delete();
    }

    // Get paginated list
    public function getAllPaginated($perPage = 10)
    {
        return Faq::latest()->paginate($perPage);
    }

    // Get single FAQ by ID
    public function getById($id)
    {
        return Faq::findOrFail($id);
    }
}
