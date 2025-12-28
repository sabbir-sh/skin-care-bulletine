<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'status',
        'slug',
    ];

    public function donors()
{
    return $this->hasMany(Donor::class);
}
}
