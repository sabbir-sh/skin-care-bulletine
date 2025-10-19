<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class CategoryService
{
    public function getAll()
    {
        return Category::orderBy('created_at', 'desc')->get();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $bannerPath = isset($data['banner']) ? $data['banner']->store('uploads/category/banner', 'public') : null;
            $iconPath = isset($data['icon']) ? $data['icon']->store('uploads/category/icon', 'public') : null;

            Category::create([
                'name' => $data['name'],
                'slug' => $data['slug'] ?? Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? 1,
                'banner' => $bannerPath,
                'icon' => $iconPath,
            ]);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            if (isset($data['banner'])) {
                if ($category->banner && Storage::disk('public')->exists($category->banner)) {
                    Storage::disk('public')->delete($category->banner);
                }
                $data['banner'] = $data['banner']->store('uploads/category/banner', 'public');
            } else {
                $data['banner'] = $category->banner;
            }

            if (isset($data['icon'])) {
                if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                    Storage::disk('public')->delete($category->icon);
                }
                $data['icon'] = $data['icon']->store('uploads/category/icon', 'public');
            } else {
                $data['icon'] = $category->icon;
            }

            $category->update([
                'name' => $data['name'],
                'slug' => $data['slug'] ?? Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? 1,
                'banner' => $data['banner'],
                'icon' => $data['icon'],
            ]);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            if ($category->banner && Storage::disk('public')->exists($category->banner)) {
                Storage::disk('public')->delete($category->banner);
            }
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            $category->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
