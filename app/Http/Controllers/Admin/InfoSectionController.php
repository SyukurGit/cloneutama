<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache; // <-- TAMBAHKAN INI

class InfoSectionController extends Controller
{
    public function edit()
    {
        Gate::authorize('isSuperAdmin');
        $section = InfoSection::firstOrCreate(
            ['id' => 1],
            ['title' => 'Default Title', 'slogan' => 'Default Slogan', 'content' => 'Default content.']
        );
        return view('admin.info_section.edit', compact('section'));
    }

    public function update(Request $request)
    {
        Gate::authorize('isSuperAdmin');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $section = InfoSection::find(1);
        $section->update($validated);
        
        $section->is_active = $request->has('is_active');
        $section->save();

        // ===============================================
        //      INI SOLUSINYA: HAPUS CACHE LAMA
        // ===============================================
        Cache::forget('info_section');

        return redirect()->route('admin.info_section.edit')->with('success', 'Info Section berhasil diperbarui.');
    }
}