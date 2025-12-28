<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'image',
         'blood_group_id',
        'date_of_birth', 'gender', 'last_donation_date',
        'district', 'upazila', 'is_available', 'status','union', 'village'
    ];

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
