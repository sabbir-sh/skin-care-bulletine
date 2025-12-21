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

        // Logo
        if (isset($data['logo'])) {
            $data['logo'] = $this->uploadFile($data['logo'], 'logo', $setting->logo);
        } else {
            unset($data['logo']);
        }

        // Favicon
        if (isset($data['favicon'])) {
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

        unset($data['facebook'], $data['twitter'], $data['youtube']);

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
