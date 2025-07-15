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
        } else {
            // Jika tidak ada gambar, gunakan path gambar default
            $validatedData['image'] = 'images/default-news.jpg';
        }

        $news = News::create($validatedData);
        
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $tagsToSync = $request->tags ?? [];
        if ($defaultTag) {
            $tagsToSync[] = $defaultTag->id;
        }
        $news->tags()->sync($tagsToSync);

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
            'tags' => 'nullable|array'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika bukan gambar default
            if ($beritum->image && $beritum->image !== 'images/default-news.jpg') {
                Storage::disk('public')->delete($beritum->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }
        
        $beritum->update($validatedData);
        
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $tagsToSync = $request->tags ?? [];
        if ($defaultTag) {
            $tagsToSync[] = $defaultTag->id;
        }
        $beritum->tags()->sync($tagsToSync);
        
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }
    
    /**
     * Menghapus berita dari database dan storage.
     */
    public function destroy(News $beritum)
    {
        Gate::authorize('manage-news');

        // Hapus gambar dari storage, kecuali jika itu adalah gambar default
        if ($beritum->image && $beritum->image !== 'images/default-news.jpg') {
            Storage::disk('public')->delete($beritum->image);
        }
        
        // Hapus relasi tags terlebih dahulu
        $beritum->tags()->detach();

        // Hapus record berita dari database
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Menangani upload gambar dari editor Trix.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $path = $request->file('file')->store('content_images', 'public');

        return response()->json(['location' => asset('storage/' . $path)]);
    }
}
