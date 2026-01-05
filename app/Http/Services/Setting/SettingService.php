<?php

namespace App\Http\Services\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function get(): ?Setting { return Setting::first(); }

    public function update(array $data): Setting
    {
        $setting = Setting::firstOrCreate([]);

        // ১. লোগো হ্যান্ডেলিং
        if (!empty($this->getInputData('logo_remove'))) {
            $this->deleteOldFile($setting->logo);
            $setting->logo = null;
        }
        if (request()->hasFile('logo')) {
            $setting->logo = $this->uploadFile(request()->file('logo'), 'logo', $setting->logo);
        }

        // ২. ফেভিকন হ্যান্ডেলিং
        if (!empty($this->getInputData('favicon_remove'))) {
            $this->deleteOldFile($setting->favicon);
            $setting->favicon = null;
        }
        if (request()->hasFile('favicon')) {
            $setting->favicon = $this->uploadFile(request()->file('favicon'), 'favicon', $setting->favicon);
        }

        // ৩. অন্যান্য ডাটা (ফাঁকা থাকলেও সেভ হবে)
        $setting->site_name = $data['site_name'] ?? null;
        $setting->meta_title = $data['meta_title'] ?? null;
        $setting->meta_description = $data['meta_description'] ?? null;
        $setting->homepage_layout = $data['homepage_layout'];
        
        $setting->social_links = [
            'facebook' => $data['facebook'] ?? null,
            'twitter'  => $data['twitter'] ?? null,
            'youtube'  => $data['youtube'] ?? null,
        ];

        $setting->save();
        return $setting;
    }

    // Helper: রিকোয়েস্ট থেকে ডাটা নেওয়া (যেহেতু validated() অনেক সময় hidden field পায় না)
    private function getInputData($key) {
        return request()->input($key);
    }

    private function uploadFile($file, $prefix, $oldFile) {
        $this->deleteOldFile($oldFile);
        return $file->store("settings/{$prefix}", 'public');
    }

    private function deleteOldFile($path) {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}