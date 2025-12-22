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

    // Index + edit form
    public function index()
    {
        $data['setting'] = $this->settingService->get();
        return view('backend.settings.index', $data);
    }

    // Create or update
    public function update(SettingRequest $request)
    {
        $this->settingService->update($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully');
    }
}
