<?php

namespace App\Http\Services\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function get(): ?Setting
    {
        return Setting::first();
    }

    public function update(array $data): Setting
    {
        $setting = Setting::firstOrCreate([]);

        // Remove logo
        if(!empty($data['logo_remove'])) {
            if($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $setting->logo = null;
        }

        // Remove favicon
        if(!empty($data['favicon_remove'])) {
            if($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $setting->favicon = null;
        }

        // Upload new files
        if(isset($data['logo'])) {
            $setting->logo = $this->uploadFile($data['logo'], 'logo', $setting->logo);
        }

        if(isset($data['favicon'])) {
            $setting->favicon = $this->uploadFile($data['favicon'], 'favicon', $setting->favicon);
        }

        // Social links
        $setting->social_links = [
            'facebook' => $data['facebook'] ?? null,
            'twitter'  => $data['twitter'] ?? null,
            'youtube'  => $data['youtube'] ?? null,
        ];

        // Other fields
        $setting->site_name = $data['site_name'] ?? $setting->site_name;
        $setting->meta_title = $data['meta_title'] ?? $setting->meta_title;
        $setting->meta_description = $data['meta_description'] ?? $setting->meta_description;
        $setting->homepage_layout = $data['homepage_layout'] ?? $setting->homepage_layout;

        $setting->save(); // ✅ Important: save() to persist changes

        return $setting;
    }

    private function uploadFile($file, string $prefix, ?string $oldFile = null): string
    {
        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }
        return $file->store("settings/{$prefix}", 'public');
    }
}
