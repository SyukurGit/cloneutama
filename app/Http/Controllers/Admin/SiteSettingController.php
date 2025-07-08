<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        // Ambil semua data setting dan ubah menjadi format 'key' => 'value' agar mudah diakses di view
        $settings = Setting::all()->pluck('value', 'key');

        // Pastikan view ada di resources/views/admin/settings/index.blade.php
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token');

        foreach ($settings as $key => $value) {
            // Jika request adalah file (untuk gambar)
            if ($request->hasFile($key)) {
                // Hapus gambar lama jika ada
                $oldImage = Setting::find($key);
                if ($oldImage && $oldImage->value) {
                    Storage::disk('public')->delete($oldImage->value);
                }
                // Simpan gambar baru
                $path = $request->file($key)->store('site_images', 'public');
                $value = $path;
            }

            // updateOrCreate akan membuat data baru jika belum ada, atau update jika sudah ada
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}