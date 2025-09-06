<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Leadership;
use App\Models\Testimonial;
use App\Models\InfoSection;
use App\Models\Setting;
use App\Models\Facility; // 1. IMPORT MODEL FACILITY

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor publik (halaman utama).
     */
    public function index()
    {
        // Mengambil semua settings dari database
        $settings = Setting::all()->keyBy('key');

        // Mengambil data lain yang dibutuhkan untuk halaman utama
        $testimonials = Testimonial::all();
        $leaderships = Leadership::orderBy('order')->get();
        $news = News::latest()->take(3)->get();
        $infoSection = InfoSection::where('is_active', true)->first();
        
        // 2. AMBIL SEMUA DATA FASILITAS
        $facilities = Facility::all();

        // 3. KIRIM SEMUA DATA KE VIEW 'welcome'
        return view('welcome', compact(
            'settings',
            'testimonials',
            'leaderships',
            'news',
            'infoSection',
            'facilities' // Pastikan variabel ini ditambahkan
        ));
    }
}