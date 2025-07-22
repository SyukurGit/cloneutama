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
    // Method index tidak diubah
    public function index(Request $request)
    {
        Gate::authorize('manage-news');
        $tags = Tag::all();
        $query = News::query()->with('tags');

        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'terbaru') {
            $query->latest('published_at');
        } else {
            $query->oldest('published_at');
        }

        $selectedTags = $request->input('tags', []);
        if (!empty($selectedTags)) {
            $query->whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('tags.id', $selectedTags);
            });
        }
        
        $search = $request->input('search');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $newsItems = $query->paginate(12)->appends($request->query());

        return view('admin.berita.index', [
            'newsItems' => $newsItems,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
            'sort' => $sort,
            'search' => $search
        ]);
    }

    // Method create tidak diubah
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

        // ===============================================
        //           PENAMBAHAN KEAMANAN XSS
        // ===============================================
        $validatedData['content'] = clean($request->input('content'));

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

    // Method edit tidak diubah
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

        // ===============================================
        //           PENAMBAHAN KEAMANAN XSS
        // ===============================================
        $validatedData['content'] = clean($request->input('content'));

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
    
    // Method destroy 
     public function destroy(News $beritum)
    {
        Gate::authorize('manage-news');
        $beritum->delete(); // Ini akan otomatis menjadi soft delete
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipindahkan ke tong sampah.');
    }

// trash logic

 public function trash(Request $request)
    {
        Gate::authorize('manage-news');
        // Ambil hanya berita yang ada di tong sampah
        $query = News::onlyTrashed()->with('tags');
        $search = $request->input('search');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        $trashedItems = $query->latest('deleted_at')->paginate(12)->appends($request->query());
        return view('admin.berita.trash', compact('trashedItems', 'search'));
    }

    public function restore($id)
    {
        Gate::authorize('manage-news');
        $news = News::onlyTrashed()->findOrFail($id);
        $news->restore();
        return redirect()->route('admin.berita.trash')->with('success', 'Berita berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        Gate::authorize('manage-news');
        $news = News::onlyTrashed()->findOrFail($id);
        // Hapus file gambar jika ada sebelum hapus permanen
        if ($news->image && $news->image !== 'images/default-news.jpg') {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image);
        }
        $news->forceDelete();
        return redirect()->route('admin.berita.trash')->with('success', 'Berita berhasil dihapus permanen.');
    }














    // Method uploadImage tidak diubah
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);
        $path = $request->file('file')->store('content_images', 'public');
        return response()->json(['location' => asset('storage/' . $path)]);
    }
}