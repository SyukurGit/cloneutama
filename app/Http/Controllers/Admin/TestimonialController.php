<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Menampilkan daftar semua testimoni.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Menampilkan form untuk membuat testimoni baru.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Menyimpan testimoni baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $imagePath = $request->file('image')->store('testimonials', 'public');

        Testimonial::create([
            'name' => $request->name,
            'quote' => $request->quote,
            'image_path' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit testimoni.
     * * @param \App\Models\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Memperbarui data testimoni di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar jadi opsional saat update
            'link' => 'nullable|url',
        ]);

        $data = $request->only(['name', 'quote', 'link']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama sebelum upload yang baru
            if ($testimonial->image_path) {
                Storage::disk('public')->delete($testimonial->image_path);
            }
            // Simpan gambar baru dan tambahkan path-nya ke data
            $data['image_path'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Menghapus testimoni dari database.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Hapus file gambar dari storage
        if ($testimonial->image_path) {
            Storage::disk('public')->delete($testimonial->image_path);
        }
        
        // Hapus data dari database
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}