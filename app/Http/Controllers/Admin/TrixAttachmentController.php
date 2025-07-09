<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrixAttachmentController extends Controller
{
    /**
     * Menyimpan file yang di-upload dari Trix Editor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Batasi hanya untuk gambar
        ]);

        $path = $request->file('file')->store('trix_attachments', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Menghapus file saat dihapus dari Trix Editor.
     */
    public function destroy(Request $request)
    {
        // Mengambil path relatif dari URL lengkap
        $path = str_replace(asset('storage') . '/', '', $request->input('url'));
        
        Storage::disk('public')->delete($path);

        return response()->noContent();
    }
}