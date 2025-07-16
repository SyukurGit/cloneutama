<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsPageController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua tag untuk ditampilkan sebagai filter
        $tags = Tag::all();
        $activeTag = null;

        // 2. Query dasar untuk berita, diurutkan berdasarkan tanggal publikasi terbaru
        $query = News::where('status', 'Posted')->latest('published_at');

        // 3. Cek apakah ada permintaan filter berdasarkan tag di URL
        if ($request->has('tag')) {
            $tagSlug = $request->query('tag');
            $activeTag = Tag::where('slug', $tagSlug)->first();

            // Jika tag yang diminta ada, filter berita berdasarkan tag tersebut
            if ($activeTag && $activeTag->slug !== 'postgraduate') {
                $query->whereHas('tags', function ($q) use ($tagSlug) {
                    $q->where('slug', $tagSlug);
                });
            }
            // Jika tag adalah 'postgraduate', tidak perlu filter tambahan (tampilkan semua)
        }

        // 4. Eksekusi query dengan pagination (9 berita per halaman)
        $news = $query->paginate(9);

        // 5. Kirim data ke view
        return view('news-index', [
            'newsItems' => $news,
            'tags' => $tags,
            'activeTag' => $activeTag
        ]);
    }
}
