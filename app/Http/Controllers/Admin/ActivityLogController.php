<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Pastikan hanya Super Admin yang bisa mengakses
        Gate::authorize('isSuperAdmin');

        // Ambil 25 aktivitas terakhir (tidak hanya 24 jam) agar lebih informatif
        $recentActivities = Activity::latest()->limit(25)->get();

        return view('admin.activity_log.index', compact('recentActivities'));
    }
}