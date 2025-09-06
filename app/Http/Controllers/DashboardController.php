<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use App\Models\Testimonial;
use App\Models\Tag;
use App\Models\Facility; // Pastikan model ini di-import
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
        
        // Mengambil data fasilitas dari database
        $facilities = Facility::latest()->get();

        // Mengirim semua data ke view 'db'
        return view('db', [
            'newsItems'    => $latestNews,
            'leaders'      => $leaders,
            'testimonials' => $testimonials,
            'facilities'   => $facilities, // Variabel ini sudah benar
        ]);
    }

    /**
     * Menampilkan halaman arsip berita.
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
            'tags'      => $tags,
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