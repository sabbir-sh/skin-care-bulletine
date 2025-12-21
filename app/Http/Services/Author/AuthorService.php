<?php

namespace App\Http\Services\Author;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    public function getAll()
    {
        return Author::latest()->paginate(10);
    }

    public function create(array $data)
    {
        if (!empty($data['avatar'])) {
            $data['avatar'] = $data['avatar']->store('authors', 'public');
        }

        return Author::create($data);
    }

    public function update(Author $author, array $data)
    {
        if (!empty($data['avatar'])) {
            // delete old avatar
            if ($author->avatar && Storage::disk('public')->exists($author->avatar)) {
                Storage::disk('public')->delete($author->avatar);
            }

            $data['avatar'] = $data['avatar']->store('authors', 'public');
        } else {
            unset($data['avatar']);
        }

        $author->update($data);
        return $author;
    }

    public function delete(Author $author)
    {
        if ($author->avatar && Storage::disk('public')->exists($author->avatar)) {
            Storage::disk('public')->delete($author->avatar);
        }

        return $author->delete();
    }
}
