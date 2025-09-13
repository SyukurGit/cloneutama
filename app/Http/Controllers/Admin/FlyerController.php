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

        $path = $request->file('image')->store('public/flyers');

        Flyer::create([
            'title' => $request->title,
            'image_path' => $path,
            'order' => $request->order,
            'is_active' => $request->has('is_active') ? $request->is_active : false,
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
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::delete($flyer->image_path);
            // Simpan gambar baru
            $data['image_path'] = $request->file('image')->store('public/flyers');
        }

        $flyer->update($data);

        return redirect()->route('admin.flyers.index')->with('success', 'Flyer berhasil diperbarui.');
    }

    public function destroy(Flyer $flyer)
    {
        // Hapus gambar dari storage
        Storage::delete($flyer->image_path);
        // Hapus data dari database
        $flyer->delete();

        return redirect()->route('admin.flyers.index')->with('success', 'Flyer berhasil dihapus.');
    }
}