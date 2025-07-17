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
    // Method `index` akan diubah secara keseluruhan
    public function index(Request $request)
    {
        Gate::authorize('manage-news');

        // Mengambil semua tag untuk filter dropdown
        $tags = Tag::all();

        // Memulai query builder
        $query = News::query()->with('tags');

        // 1. Logika untuk Sorting (Terbaru/Lama)
        $sort = $request->input('sort', 'terbaru'); // Default 'terbaru'
        if ($sort === 'terbaru') {
            $query->latest('published_at');
        } else {
            $query->oldest('published_at');
        }

        // 2. Logika untuk Filter berdasarkan Tags
        $selectedTags = $request->input('tags', []);
        if (!empty($selectedTags)) {
            $query->whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('tags.id', $selectedTags);
            });
        }
        
        // 3. Logika untuk Pencarian
        $search = $request->input('search');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // 4. Pagination
        $newsItems = $query->paginate(12)->appends($request->query());

        // Mengirim data ke view
        return view('admin.berita.index', [
            'newsItems' => $newsItems,
            'tags' => $tags,
            'selectedTags' => $selectedTags, // Untuk menandai checkbox yang aktif
            'sort' => $sort, // Untuk menandai urutan yang aktif
            'search' => $search // Untuk menampilkan query pencarian
        ]);
    }

    // Method lainnya (create, store, edit, dll.) tetap sama ...
    // ...
    // Pastikan method lain tidak diubah, hanya method index saja.

    public function create()
    {
        Gate::authorize('manage-news');
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $otherTags = Tag::where('slug', '!=', 'pascasarjana')->get();

        return view('admin.berita.create', [
            'defaultTag' => $defaultTag,
            'otherTags' => $otherTags
        ]);
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
            $validatedData['image'] = 'images/default-news.jpg';
        }

        $news = News::create($validatedData);
        
        $tagsToSync = $request->input('tags', []);

        if (empty($tagsToSync)) {
            $defaultTag = Tag::where('slug', 'pascasarjana')->first();
            if ($defaultTag) {
                $tagsToSync = [$defaultTag->id];
            }
        }
        
        $news->tags()->sync($tagsToSync);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    public function edit(News $beritum)
    {
        Gate::authorize('manage-news');
        $defaultTag = Tag::where('slug', 'pascasarjana')->first();
        $otherTags = Tag::where('slug', '!=', 'pascasarjana')->get();
        
        return view('admin.berita.edit', [
            'news' => $beritum,
            'defaultTag' => $defaultTag,
            'otherTags' => $otherTags
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
            if ($beritum->image && $beritum->image !== 'images/default-news.jpg') {
                Storage::disk('public')->delete($beritum->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }
        
        $beritum->update($validatedData);
        
        $tagsToSync = $request->input('tags', []);

        if (empty($tagsToSync)) {
            $defaultTag = Tag::where('slug', 'pascasarjana')->first();
            if ($defaultTag) {
                $tagsToSync = [$defaultTag->id];
            }
        }
        
        $beritum->tags()->sync($tagsToSync);
        
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }
    
    public function destroy(News $beritum)
    {
        Gate::authorize('manage-news');

        if ($beritum->image && $beritum->image !== 'images/default-news.jpg') {
            Storage::disk('public')->delete($beritum->image);
        }
        
        $beritum->tags()->detach();
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);
        $path = $request->file('file')->store('content_images', 'public');
        return response()->json(['location' => asset('storage/' . $path)]);
    }
}