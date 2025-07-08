<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Menampilkan daftar semua program studi, dikelompokkan berdasarkan jenjang.
     */
    public function index()
    {
        $programs = StudyProgram::all()->groupBy('level');
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Menampilkan form untuk membuat program studi baru.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Menyimpan program studi baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:S2,S3',
            'accreditation' => 'nullable|string|max:100',
            'link' => 'nullable|url',
        ]);

        StudyProgram::create($validatedData);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit program studi.
     */
    public function edit(StudyProgram $program_studi)
    {
        return view('admin.programs.edit', ['program' => $program_studi]);
    }

    /**
     * Memperbarui data program studi di database.
     */
    public function update(Request $request, StudyProgram $program_studi)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:S2,S3',
            'accreditation' => 'nullable|string|max:100',
            'link' => 'nullable|url',
        ]);

        $program_studi->update($validatedData);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil diperbarui!');
    }

    /**
     * Menghapus program studi dari database.
     */
    public function destroy(StudyProgram $program_studi)
    {
        $program_studi->delete();

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil dihapus!');
    }
}