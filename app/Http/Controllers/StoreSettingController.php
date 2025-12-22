<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreSettingController extends Controller
{
    /**
     * Display the store settings form.
     */
    public function index()
    {
        $setting = StoreSetting::first();

        // Create default setting if none exists
        if (! $setting) {
            $setting = StoreSetting::create([
                'store_name' => 'ComfyApparel',
            ]);
        }

        return view('admin.pengaturan.index', compact('setting'));
    }

    /**
     * Update the store settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $setting = StoreSetting::first();

        if (! $setting) {
            $setting = new StoreSetting;
        }

        $setting->store_name = $request->store_name;
        $setting->whatsapp = $request->whatsapp;
        $setting->address = $request->address;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $setting->logo = $logoPath;
        }

        $setting->save();

        // Clear the cache
        StoreSetting::clearCache();

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan toko berhasil disimpan!');
    }
}
