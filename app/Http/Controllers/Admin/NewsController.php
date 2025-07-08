<?php

// PASTIKAN NAMESPACE-NYA SUDAH BENAR SEPERTI INI
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // PENTING: Jangan dihapus
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua berita.
     */
    public function index()
    {
        $allNews = News::latest()->get();
        // Pastikan view ini ada: resources/views/admin/berita/index.blade.php
        return view('admin.berita.index', ['newsItems' => $allNews]);
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        // Pastikan view ini ada: resources/views/admin/berita/create.blade.php
        return view('admin.berita.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_id' => 'required|string',
            'content_en' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        News::create($validatedData);

        // Arahkan kembali ke halaman daftar berita dengan route baru
        return redirect()->route('admin.berita.index')->with('success', 'Berita baru berhasil disimpan!');
    }


    /**
     * Menghapus berita dari storage dan database.
     */
    public function destroy(News $news): RedirectResponse
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        // Arahkan kembali ke halaman daftar berita dengan route baru
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    // Nanti kita akan tambahkan method show() dan edit() di sini jika diperlukan
}