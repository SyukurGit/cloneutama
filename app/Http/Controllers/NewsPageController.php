<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsPageController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua tag dan kata kunci pencarian dari request
        $tags = Tag::all();
        $activeTag = null;
        $searchTerm = $request->input('search'); // Pindahkan ini ke atas

        // 2. Query dasar untuk berita
        $query = News::where('status', 'Posted')->latest('published_at');

        // 3. Filter berdasarkan tag
        if ($request->has('tag')) {
            $tagSlug = $request->query('tag');
            $activeTag = Tag::where('slug', $tagSlug)->first();

            if ($activeTag) {
                // Gunakan whereHas untuk memfilter berita yang memiliki tag tersebut
                $query->whereHas('tags', function ($q) use ($tagSlug) {
                    $q->where('slug', $tagSlug);
                });
            }
        }

        // 4. Filter berdasarkan kata kunci pencarian
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        // 5. Eksekusi query dengan pagination
        // withQueryString() akan otomatis membawa semua filter (tag & search) saat pindah halaman
        $newsItems = $query->paginate(9)->withQueryString();

        // 6. Kirim data ke view
        return view('news-index', [
            'newsItems' => $newsItems,
            'tags' => $tags,
            'activeTag' => $activeTag,
            'searchTerm' => $searchTerm,
        ]);
    }
}