<?php

namespace App\Http\Controllers;

use App\Models\Facility; // <-- Import model Facility
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        // Ambil semua data fasilitas dari database
        $facilities = Facility::latest()->get();

        // Kirim data ke view profile/index.blade.php
        return view('profile.index', compact('facilities'));
    }
}