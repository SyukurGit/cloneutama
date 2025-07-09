<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor publik dengan semua berita dan pimpinan.
     */
    public function index()
    {
        // 1. Ambil data berita terbaru (maksimal 4)
        $latestNews = News::latest()->take(4)->get();

        // 2. Ambil data pimpinan berdasarkan urutan
        $leaders = Leadership::orderBy('order')->get();
         $testimonials = Testimonial::latest()->get();

        // 3. Kirim data ke view 'db'
        return view('db', [
            'newsItems' => $latestNews,
            'leaders'   => $leaders,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(News $news)
    {
        // Kirim data berita yang ditemukan ke view 'news-detail'
        return view('news-detail', ['news' => $news]);
    }
}
