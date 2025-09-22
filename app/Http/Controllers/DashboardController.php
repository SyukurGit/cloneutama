<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use App\Models\Testimonial;
use App\Models\Tag;
use App\Models\Facility; // Pastikan model ini di-import
use App\Models\Information; 
use App\Models\Flyer; // 1. TAMBAHKAN: Import model Flyer
// <-- 1. IMPORT MODEL INFORMATION
use App\Models\Setting; // <-- 1. PASTIKAN MODEL SETTING DI-IMPORT
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

       // 2. LOGIKA KONDISIONAL UNTUK MENGAMBIL DATA
        $informations = collect(); // Buat koleksi kosong sebagai default
        $isInformationSectionEnabled = Setting::where('key', 'information_section_enabled')->first()->value ?? 'true';

        if ($isInformationSectionEnabled === 'true') {
            $informations = Information::latest()->get();
        }

         $flyers = Flyer::where('is_active', true)
                       ->orderBy('order', 'asc')
                       ->take(3)
                       ->get();

        // Mengirim semua data ke view 'db'
        return view('db', [
            'newsItems'    => $latestNews,
            'leaders'      => $leaders,
            'testimonials' => $testimonials,
            'facilities'   => $facilities, // Variabel ini sudah benar
            'informations' => $informations, // <-- Data informasi ditambahkan di sini
            'flyers'       => $flyers,
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