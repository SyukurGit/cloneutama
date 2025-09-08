<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThesisSchedule;
use Illuminate\Http\Request;
use App\Models\StudyProgram; // 1. TAMBAHKAN USE STATEMENT INI


class ThesisScheduleController extends Controller
{
    public function index()
    {
        $schedules = ThesisSchedule::orderBy('order', 'asc')->get();
        
        // 2. TAMBAHKAN BARIS UNTUK MENGAMBIL DATA PROGRAM STUDI
        $studyPrograms = StudyProgram::where('is_published', true)->get();

        // 3. KIRIM KEDUA VARIABEL KE VIEW MENGGUNAKAN compact()
        return view('thesis-schedule', compact('schedules', 'studyPrograms'));
    }

    public function create()
    {
        return view('admin.thesis_schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'order' => 'required|integer',
        ]);

        ThesisSchedule::create($request->all());

        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule created successfully.');
    }

    public function edit(ThesisSchedule $thesisSchedule)
    {
        return view('admin.thesis_schedules.edit', compact('thesisSchedule'));
    }

    public function update(Request $request, ThesisSchedule $thesisSchedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'order' => 'required|integer',
        ]);

        $thesisSchedule->update($request->all());

        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule updated successfully.');
    }

    public function destroy(ThesisSchedule $thesisSchedule)
    {
        $thesisSchedule->delete();
        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule deleted successfully.');
    }
}