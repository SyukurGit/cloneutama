<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard admin.
     */
    public function index()
    {
        // Mengarahkan ke view baru yang akan kita buat
        return view('admin.dashboard');
    }
}