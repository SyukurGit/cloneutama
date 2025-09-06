<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->get();
        $facilityCount = Facility::count();
        return view('admin.facilities.index', compact('facilities', 'facilityCount'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // 2. Simpan gambar
        $imagePath = $request->file('image')->store('public/facilities');
        $imagePath = str_replace('public/', '', $imagePath); // Hapus 'public/' dari path

        // 3. Buat data di database
        Facility::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
        ]);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('facilities.index')->with('success', 'Fasilitas baru berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $facility->image_path; // Simpan path lama

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete('public/' . $facility->image_path);

            // Simpan gambar baru
            $newImagePath = $request->file('image')->store('public/facilities');
            $imagePath = str_replace('public/', '', $newImagePath);
        }

        $facility->update([
            'title' => $validated['title'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        // 1. Hapus gambar dari storage
        Storage::delete('public/' . $facility->image_path);

        // 2. Hapus data dari database
        $facility->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}