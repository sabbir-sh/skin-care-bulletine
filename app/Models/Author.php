<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'email',
        'bio',
        'avatar',
        'facebook',
        'twitter',
        'linkedin',
    ];

    /* Accessor for avatar */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('images/default-user.png');
    }

    /* Author blogs */
    public function blogs()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }
}
