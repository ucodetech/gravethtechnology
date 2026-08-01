<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Traits\UploadsImages;

class SettingController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'profile_image']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('profile_image')) {
            try {
                $imageUrl = $this->uploadToCloudinary($request->file('profile_image'), 'portfolio');
                Setting::updateOrCreate(['key' => 'profile_image'], ['value' => $imageUrl]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Image upload failed: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['success' => true, 'message' => 'Settings updated successfully!']);
    }
}
