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
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Ambil semua data dari request kecuali token
        $settings = $request->except('_token');

        // ==========================================================
        //         TAMBAHKAN LOGIKA INI UNTUK MENANGANI SWITCH
        // ==========================================================
        // Jika 'director_greeting_enabled' tidak ada di request (artinya switch 'off'),
        // kita set nilainya menjadi 'off' secara manual sebelum menyimpan.
        if (!$request->has('director_greeting_enabled')) {
            $settings['director_greeting_enabled'] = 'off';
        }
        // ==========================================================
        //                  AKHIR LOGIKA BARU
        // ==========================================================

        foreach ($settings as $key => $value) {
            if ($request->hasFile($key)) {
                $oldImage = Setting::find($key);
                if ($oldImage && $oldImage->value) {
                    Storage::disk('public')->delete($oldImage->value);
                }
                $path = $request->file($key)->store('site_images', 'public');
                $value = $path;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
       
        return redirect()->route('admin.director_settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}