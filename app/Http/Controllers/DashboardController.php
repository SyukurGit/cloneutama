<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use App\Models\Testimonial;
use App\Models\Tag;
use App\Models\Facility; // 1. TAMBAHKAN MODEL FACILITY
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor publik (halaman utama).
     */
    public function index()
    {
        // Kode lama Anda (tetap dipertahankan)
        $latestNews = News::with('tags')->latest('published_at')->take(4)->get();
        $leaders = Leadership::orderBy('order')->get();
        $testimonials = Testimonial::latest()->get();

        // 2. TAMBAHKAN LOGIKA UNTUK MENGAMBIL DATA FASILITAS
        $facilities = Facility::latest()->get();

        // 3. TAMBAHKAN VARIABEL $facilities KE DALAM ARRAY VIEW
        return view('db', [
            'newsItems'    => $latestNews,
            'leaders'      => $leaders,
            'testimonials' => $testimonials,
            'facilities'   => $facilities, // <-- Data fasilitas ditambahkan di sini
        ]);
    }

    /**
     * ==========================================================
     * METHOD LAMA ANDA UNTUK ARSIP BERITA (TIDAK DIUBAH)
     * ==========================================================
     */
    public function newsIndex(Request $request)
    {
        $tags = Tag::all();
        $activeTag = null;

        $newsQuery = News::with('tags')->latest('published_at');

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

        return view('news-index', [
            'newsItems' => $newsItems,
            'tags' => $tags,
            'activeTag' => $activeTag,
        ]);
    }

    /**
     * Menampilkan detail berita. (TIDAK DIUBAH)
     */
    public function show(News $news)
    {
        return view('news-detail', ['news' => $news]);
    }
}