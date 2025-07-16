<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use App\Models\Testimonial;
use App\Models\Tag; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor publik (halaman utama).
     */
    public function index()
    {
        $latestNews = News::with('tags')->latest('published_at')->take(4)->get();
        $leaders = Leadership::orderBy('order')->get();
        $testimonials = Testimonial::latest()->get();

        return view('db', [
            'newsItems' => $latestNews,
            'leaders'   => $leaders,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * ==========================================================
     * TAMBAHKAN METHOD BARU INI UNTUK ARSIP BERITA
     * ==========================================================
     */
    public function newsIndex(Request $request)
    {
        $tags = Tag::all();
        $activeTag = null;

        $newsQuery = News::with('tags')->latest('published_at');

        // Jika ada filter tag di URL (contoh: /berita?tag=pascasarjana)
        if ($request->has('tag')) {
            $tagSlug = $request->input('tag');
            $activeTag = Tag::where('slug', $tagSlug)->first();
            if ($activeTag) {
                $newsQuery->whereHas('tags', function ($query) use ($tagSlug) {
                    $query->where('slug', $tagSlug);
                });
            }
        }

        $newsItems = $newsQuery->paginate(9)->withQueryString();

        // Menggunakan view news-index yang sudah kamu buat
        return view('news-index', [
            'newsItems' => $newsItems,
            'tags' => $tags,
            'activeTag' => $activeTag,
        ]);
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(News $news)
    {
        return view('news-detail', ['news' => $news]);
    }
}