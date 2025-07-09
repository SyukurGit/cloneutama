<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $allNews = News::latest()->get();
        return view('admin.berita.index', ['newsItems' => $allNews]);
    }

    public function create()
    {
        return view('admin.berita.create'); // Tidak perlu kirim data prodi lagi
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        News::create($validatedData);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    public function edit(News $beritum)
    {
        return view('admin.berita.edit', ['news' => $beritum]); // Tidak perlu kirim data prodi
    }

    public function update(Request $request, News $beritum)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($beritum->image) Storage::disk('public')->delete($beritum->image);
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $beritum->update($validatedData);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $beritum)
    {
        if ($beritum->image) Storage::disk('public')->delete($beritum->image);
        $beritum->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }


public function uploadImage(Request $request)
{
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $file = $request->file('file');
    $path = $file->store('content_images', 'public');

    // Pastikan response JSON-nya seperti ini, mengembalikan URL lengkap.
    return response()->json(['location' => asset('storage/' . $path)]);
}
}