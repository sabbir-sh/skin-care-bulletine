<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'banner',
        'icon',
    ];

    /**
     * Access full banner image URL.
     */
    public function getBannerUrlAttribute()
    {
        return $this->banner
            ? asset('storage/' . $this->banner)
            : asset('images/default-banner.png');
    }

    /**
     * Access full icon image URL.
     */
    public function getIconUrlAttribute()
    {
        return $this->icon
            ? asset('storage/' . $this->icon)
            : asset('images/default-icon.png');
    }

    /**
     * Scope active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
