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

    // Remove logo if requested
    if(!empty($data['logo_remove'])) {
        if($setting->logo && Storage::disk('public')->exists($setting->logo)) {
            Storage::disk('public')->delete($setting->logo);
        }
        $setting->logo = null;
    }

    // Remove favicon if requested
    if(!empty($data['favicon_remove'])) {
        if($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
            Storage::disk('public')->delete($setting->favicon);
        }
        $setting->favicon = null;
    }

    // Handle new uploads
    if(isset($data['logo'])) {
        $data['logo'] = $this->uploadFile($data['logo'], 'logo', $setting->logo);
    } else {
        unset($data['logo']);
    }

    if(isset($data['favicon'])) {
        $data['favicon'] = $this->uploadFile($data['favicon'], 'favicon', $setting->favicon);
    } else {
        unset($data['favicon']);
    }

    // Social links
    $data['social_links'] = [
        'facebook' => $data['facebook'] ?? null,
        'twitter'  => $data['twitter'] ?? null,
        'youtube'  => $data['youtube'] ?? null,
    ];

    unset($data['facebook'], $data['twitter'], $data['youtube'], $data['logo_remove'], $data['favicon_remove']);

    $setting->update($data);

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
