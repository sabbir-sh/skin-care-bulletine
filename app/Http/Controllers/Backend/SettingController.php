<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Services\Setting\SettingService;

class SettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    // Show form
    public function index()
    {
        $setting = $this->settingService->get();
        return view('backend.settings.index', compact('setting'));
    }

    // Update settings
    public function update(SettingRequest $request)
    {
        $this->settingService->update($request->validated());
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
