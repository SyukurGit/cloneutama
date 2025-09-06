<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/facilities');
        $imagePath = str_replace('public/', '', $imagePath);

        Facility::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
        ]);

        // UBAH BARIS INI
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas baru berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $facility->image_path;

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $facility->image_path);
            $newImagePath = $request->file('image')->store('public/facilities');
            $imagePath = str_replace('public/', '', $newImagePath);
        }

        $facility->update([
            'title' => $validated['title'],
            'image_path' => $imagePath,
        ]);

        // UBAH BARIS INI
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        Storage::delete('public/' . $facility->image_path);
        $facility->delete();
        
        // UBAH BARIS INI
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}