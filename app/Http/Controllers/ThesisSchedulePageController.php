<?php

namespace App\Http\Controllers;

use App\Models\ThesisSchedule;
use Illuminate\Http\Request;

class ThesisSchedulePageController extends Controller
{
    public function index()
    {
        $schedules = ThesisSchedule::orderBy('order', 'asc')->get();
        return view('thesis-schedule', compact('schedules'));
    }
}