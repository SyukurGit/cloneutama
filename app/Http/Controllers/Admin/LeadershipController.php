<?php

// app/Http/Controllers/Admin/LeadershipController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipController extends Controller
{
    public function index()
    {
        $leaders = Leadership::orderBy('order')->get();
        return view('admin.leaderships.index', compact('leaders'));
    }

    public function create()
    {
        return view('admin.leaderships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $imagePath = $request->file('image')->store('leaderships', 'public');

        Leadership::create([
            'name' => $request->name,
            'position' => $request->position,
            'image_path' => $imagePath,
            'social_link' => $request->social_link,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.pimpinan.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(Leadership $pimpinan)
    {
        return view('admin.leaderships.edit', ['leader' => $pimpinan]);
    }

    public function update(Request $request, Leadership $pimpinan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $data = $request->only(['name', 'position', 'social_link', 'order']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($pimpinan->image_path) {
                Storage::disk('public')->delete($pimpinan->image_path);
            }
            // Simpan gambar baru
            $data['image_path'] = $request->file('image')->store('leaderships', 'public');
        }

        $pimpinan->update($data);

        return redirect()->route('admin.pimpinan.index')->with('success', 'Data anggota tim berhasil diperbarui.');
    }

    public function destroy(Leadership $pimpinan)
    {
        if ($pimpinan->image_path) {
            Storage::disk('public')->delete($pimpinan->image_path);
        }
        $pimpinan->delete();
        return redirect()->route('admin.pimpinan.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}

