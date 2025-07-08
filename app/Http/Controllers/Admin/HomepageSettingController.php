<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class HomepageSettingController extends Controller
{
    /**
     * Menampilkan halaman form untuk pengaturan halaman depan.
     */
    public function index()
    {
        // Ambil semua data setting dari database dan kirimkan ke view.
        $settings = Setting::all()->pluck('value', 'key');
        
        // Pastikan view ada di resources/views/admin/settings/homepage.blade.php
        return view('admin.settings.homepage', compact('settings'));
    }

    /**
     * Menyimpan atau memperbarui semua pengaturan dari form.
     */
    public function update(Request $request)
    {
        // 1. Simpan semua input yang BUKAN file (teks, link, radio button).
        // Kita secara eksplisit mengecualikan semua kemungkinan nama input file.
        $textAndLinkInputs = $request->except([
            '_token', 
            'hero_video', 
            'hero_slide_1_image', 
            'hero_slide_2_image', 
            'hero_slide_3_image', 
            'hero_slide_4_image', 
            'hero_slide_5_image'
        ]);

        foreach ($textAndLinkInputs as $key => $value) {
            // Simpan atau perbarui setiap data teks/link.
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        // 2. Logika khusus untuk menangani upload file.
        // Jika admin memilih untuk upload VIDEO.
        if ($request->hasFile('hero_video')) {
            $this->storeFile('hero_video_path', $request->file('hero_video'));
        }

        // Jika admin memilih untuk upload GAMBAR (Slideshow).
        // Loop untuk memeriksa 5 kemungkinan input gambar.
        for ($i = 1; $i <= 5; $i++) {
            $fileInputName = 'hero_slide_' . $i . '_image';
            if ($request->hasFile($fileInputName)) {
                $this->storeFile($fileInputName, $request->file($fileInputName));
            }
        }

        // 3. Arahkan kembali ke halaman pengaturan dengan pesan sukses.
        return redirect()->route('admin.homepage_settings.index')->with('success', 'Pengaturan Halaman Depan berhasil diperbarui!');
    }

    /**
     * Helper method untuk menyimpan file dan menghapus yang lama.
     * Ini membuat kode di method update() lebih bersih.
     *
     * @param string $key Kunci yang akan disimpan di database (cth: 'hero_video_path')
     * @param \Illuminate\Http\UploadedFile $file File yang di-upload dari request
     */
    private function storeFile(string $key, $file)
    {
        // Hapus file lama jika ada untuk menghemat ruang penyimpanan.
        $oldFile = Setting::find($key);
        if ($oldFile && $oldFile->value) {
            Storage::disk('public')->delete($oldFile->value);
        }
        
        // Simpan file baru di folder 'public/homepage_media' dan catat path-nya.
        $path = $file->store('homepage_media', 'public');
        Setting::updateOrCreate(['key' => $key], ['value' => $path]);
    }
}