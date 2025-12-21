<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'meta_title',
        'meta_description',
        'social_links',
        'homepage_layout'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function getLogoUrlAttribute(): string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : asset('images/default-logo.png');
    }

    // Favicon URL
    public function getFaviconUrlAttribute(): string
    {
        return $this->favicon
            ? asset('storage/' . $this->favicon)
            : asset('images/default-favicon.png');
    }
}
