<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Setting; // <-- 1. IMPORT MODEL SETTING
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::latest()->get();
        $isSectionEnabled = Setting::where('key', 'information_section_enabled')->first()->value ?? 'true';

        return view('admin.information.index', compact('informations'));

        
    }


     public function toggleVisibility(Request $request)
    {
        $request->validate([
            'enabled' => 'required|in:true,false',
        ]);

        Setting::updateOrCreate(
            ['key' => 'information_section_enabled'],
            ['value' => $request->input('enabled')]
        );

        $message = $request->input('enabled') === 'true' ? 'Seksi Informasi berhasil diaktifkan.' : 'Seksi Informasi berhasil dinonaktifkan.';

        return back()->with('success', $message);
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'type' => ['required', Rule::in(['file', 'link'])],
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Max 1MB
            'file_path' => 'required_if:type,file|nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240', // Max 10MB
            'external_link' => 'required_if:type,link|nullable|url',
        ]);

        $data = $validated;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = str_replace('public/', '', $request->file('thumbnail')->store('public/information/thumbnails'));
        }

        if ($request->hasFile('file_path')) {
            $data['file_path'] = str_replace('public/', '', $request->file('file_path')->store('public/information/files'));
        }

        Information::create($data);

        // PERBAIKAN DI SINI
        return redirect()->route('admin.information.index')->with('success', 'Informasi baru berhasil ditambahkan.');
    }

    public function edit(Information $information)
    {
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'type' => ['required', Rule::in(['file', 'link'])],
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'file_path' => 'sometimes|nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
            'external_link' => 'required_if:type,link|nullable|url',
        ]);

        $data = $validated;

        if ($request->hasFile('thumbnail')) {
            if ($information->thumbnail) {
                Storage::delete('public/' . $information->thumbnail);
            }
            $data['thumbnail'] = str_replace('public/', '', $request->file('thumbnail')->store('public/information/thumbnails'));
        }

        if ($request->input('type') === 'file' && $request->hasFile('file_path')) {
            if ($information->file_path) {
                Storage::delete('public/' . $information->file_path);
            }
            $data['file_path'] = str_replace('public/', '', $request->file('file_path')->store('public/information/files'));
            $data['external_link'] = null;
        } elseif ($request->input('type') === 'link') {
            if ($information->file_path) {
                Storage::delete('public/' . $information->file_path);
            }
            $data['file_path'] = null;
        }

        $information->update($data);

        // PERBAIKAN DI SINI
        return redirect()->route('admin.information.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Information $information)
    {
        if ($information->thumbnail) {
            Storage::delete('public/' . $information->thumbnail);
        }
        if ($information->file_path) {
            Storage::delete('public/' . $information->file_path);
        }

        $information->delete();

        // PERBAIKAN DI SINI
        return redirect()->route('admin.information.index')->with('success', 'Informasi berhasil dihapus.');
    }
}