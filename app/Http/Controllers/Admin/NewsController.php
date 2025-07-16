<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    // ... (fungsi index, create, store tidak berubah, kita hanya fokus pada update)
    public function index()
    {
        Gate::authorize('manage-news');
        $allNews = News::latest('published_at')->get();
        return view('admin.berita.index', ['newsItems' => $allNews]);
    }

    public function create()
    {
        Gate::authorize('manage-news');
        $tags = Tag::where('slug', '!=', 'pascasarjana')->get();
        return view('admin.berita.create', compact('tags'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-news');
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
            'published_at' => 'required|date',
            'tags' => 'nullable|array'
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $news = News::create($validatedData);
        
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $tagsToSync = $request->tags ?? [];
        if ($defaultTag) {
            $tagsToSync[] = $defaultTag->id;
        }
        $news->tags()->sync(array_unique($tagsToSync));

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    public function edit(News $beritum)
    {
        Gate::authorize('manage-news');
        $tags = Tag::where('slug', '!=', 'pascasarjana')->get();
        return view('admin.berita.edit', [
            'news' => $beritum,
            'tags' => $tags
        ]);
    }

    /**
     * FUNGSI UPDATE YANG SUDAH DIPERBAIKI TOTAL
     */
    public function update(Request $request, News $beritum)
    {
        Gate::authorize('manage-news');

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'required|string|max:255',
            'status' => 'required|string',
            'published_at' => 'required|date',
            'tags' => 'nullable|array',
            'remove_image' => 'nullable|boolean' // Validasi untuk input hapus gambar
        ]);

        // Update data teks dan tanggal
        $beritum->title = $validatedData['title'];
        $beritum->content = $validatedData['content'];
        $beritum->author = $validatedData['author'];
        $beritum->status = $validatedData['status'];
        $beritum->published_at = $validatedData['published_at'];

        // Logika untuk menghapus gambar jika tombol "Hapus Gambar" diklik
        if ($request->input('remove_image') == '1') {
            if ($beritum->image && Storage::disk('public')->exists($beritum->image)) {
                Storage::disk('public')->delete($beritum->image);
            }
            $beritum->image = null; // Set kolom image menjadi kosong
        }

        // Logika untuk mengganti/menambah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($beritum->image && Storage::disk('public')->exists($beritum->image)) {
                Storage::disk('public')->delete($beritum->image);
            }
            $beritum->image = $request->file('image')->store('images', 'public');
        }
        
        // Simpan semua perubahan ke database
        $beritum->save();
        
        // Sinkronisasi Tags
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $tagsToSync = $request->tags ?? [];
        if ($defaultTag) {
            $tagsToSync[] = $defaultTag->id;
        }
        $beritum->tags()->sync(array_unique($tagsToSync));
        
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }
    
    public function destroy(News $beritum)
    {
        Gate::authorize('manage-news');
        if ($beritum->image && Storage::disk('public')->exists($beritum->image)) {
            Storage::disk('public')->delete($beritum->image);
        }
        $beritum->tags()->detach();
        $beritum->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['file' => 'required|image|max:2048']);
        $path = $request->file('file')->store('content_images', 'public');
        return response()->json(['location' => asset('storage/' . $path)]);
    }
}
