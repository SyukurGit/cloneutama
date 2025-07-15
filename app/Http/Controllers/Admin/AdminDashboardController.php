<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// TAMBAHKAN SEMUA MODEL YANG KITA BUTUHKAN
use App\Models\News;
use App\Models\StudyProgram;
use App\Models\Testimonial;
use App\Models\Leadership;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard admin.
     */
    public function index()
    {
        // 1. Ambil semua data hitungan di sini
        $newsCount = News::count();
        $studyProgramCount = StudyProgram::count();
        $testimonialCount = Testimonial::count();
        $leadershipCount = Leadership::count();

        // 2. Kirim semua data tersebut ke view
        return view('admin.dashboard', [
            'newsCount' => $newsCount,
            'studyProgramCount' => $studyProgramCount,
            'testimonialCount' => $testimonialCount,
            'leadershipCount' => $leadershipCount,
        ]);
    }
}