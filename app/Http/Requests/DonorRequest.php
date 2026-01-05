<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|max:2048',
            'blood_group_id' => 'required|exists:blood_groups,id',
            'date_of_birth' => 'required|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'last_donation_date' => 'nullable|date',
            'district' => 'required|string|max:255',
            'upazila' => 'required|string|max:255',
            'union' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',
        ];
    }
}
