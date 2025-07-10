<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Menampilkan halaman daftar semua berita.
     */
    public function index()
    {
        $allNews = News::latest()->get();
        return view('admin.berita.index', ['newsItems' => $allNews]);
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        News::create($validatedData);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    /**
     * Menampilkan form untuk mengedit berita yang ada.
     */
    public function edit(News $beritum)
    {
        return view('admin.berita.edit', ['news' => $beritum]);
    }

    /**
     * Memperbarui berita yang ada di database.
     */
    public function update(Request $request, News $beritum)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // Pastikan 'content' divalidasi
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Cek jika ada file gambar utama baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada, untuk menghemat storage
            if ($beritum->image) {
                Storage::disk('public')->delete($beritum->image);
            }
            // Simpan gambar baru
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        // Perbarui record berita dengan semua data yang sudah divalidasi
        $beritum->update($validatedData);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita dari database dan storage.
     */
    public function destroy(News $beritum)
    {
        // Hapus gambar utama dari storage
        if ($beritum->image) {
            Storage::disk('public')->delete($beritum->image);
        }
        
        // Hapus record berita dari database
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Menangani upload gambar dari editor Trix/TinyMCE.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('content_images', 'public');

        // Mengembalikan response JSON dengan URL lengkap yang dibutuhkan oleh editor
        return response()->json(['location' => asset('storage/' . $path)]);
    }
}