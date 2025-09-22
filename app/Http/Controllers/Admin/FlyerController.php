<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlyerController extends Controller
{
    public function index()
    {
        $flyers = Flyer::orderBy('order', 'asc')->get();
        return view('admin.flyers.index', compact('flyers'));
    }

    public function create()
    {
        return view('admin.flyers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        // PERBAIKAN 1: Simpan di folder 'flyers' dalam disk 'public'
        $path = $request->file('image')->store('flyers', 'public');

        Flyer::create([
            'title' => $request->title,
            'image_path' => $path, // Path yang disimpan sekarang sudah benar
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'), // Cara yang lebih baik untuk boolean
        ]);

        return redirect()->route('admin.flyers.index')->with('success', 'Flyer berhasil ditambahkan.');
    }

    public function edit(Flyer $flyer)
    {
        return view('admin.flyers.edit', compact('flyer'));
    }

    public function update(Request $request, Flyer $flyer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = $request->only('title', 'order');
        $data['is_active'] = $request->boolean('is_active'); // Cara yang lebih baik untuk boolean

        if ($request->hasFile('image')) {
            // PERBAIKAN 2: Hapus gambar lama dari disk 'public'
            if ($flyer->image_path) {
                Storage::disk('public')->delete($flyer->image_path);
            }
            // Simpan gambar baru di disk 'public'
            $data['image_path'] = $request->file('image')->store('flyers', 'public');
        }

        $flyer->update($data);

        return redirect()->route('admin.flyers.index')->with('success', 'Flyer berhasil diperbarui.');
    }

    public function destroy(Flyer $flyer)
    {
        // PERBAIKAN 3: Hapus gambar dari disk 'public'
        if ($flyer->image_path) {
            Storage::disk('public')->delete($flyer->image_path);
        }
        
        $flyer->delete();

        return redirect()->route('admin.flyers.index')->with('success', 'Flyer berhasil dihapus.');
    }
}