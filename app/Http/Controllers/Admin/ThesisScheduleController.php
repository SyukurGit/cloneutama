<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThesisSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // 1. DITAMBAHKAN: Untuk helper string

class ThesisScheduleController extends Controller
{
    /**
     * Helper function untuk memastikan URL memiliki awalan http:// atau https://.
     * Ini adalah fungsi internal untuk controller ini saja.
     */
    private function prepareUrl($url)
    {
        // Menghapus spasi di awal/akhir URL
        $url = trim($url);

        // Jika URL tidak kosong dan TIDAK diawali dengan http:// atau https://
        if (!empty($url) && !Str::startsWith($url, ['http://', 'https://'])) {
            // Maka, tambahkan https:// secara otomatis
            return 'https://' . $url;
        }

        // Jika sudah ada, kembalikan URL aslinya
        return $url;
    }

    /**
     * Menampilkan daftar semua jadwal thesis di halaman admin.
     */
    public function index()
    {
        $schedules = ThesisSchedule::orderBy('order', 'asc')->get();
        return view('admin.thesis_schedules.index', compact('schedules'));
    }

    /**
     * Menampilkan form untuk membuat jadwal thesis baru.
     */
    public function create()
    {
        return view('admin.thesis_schedules.create');
    }

    /**
     * Menyimpan jadwal thesis baru ke database.
     */
    public function store(Request $request)
    {
        // 2. DIPERBARUI: Validasi URL dibuat lebih fleksibel
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string', // Diubah dari 'url' menjadi 'string'
            'order' => 'required|integer',
        ]);

        // 3. DIPERBARUI: Proses URL sebelum disimpan
        $data = $request->all();
        $data['url'] = $this->prepareUrl($request->input('url'));

        ThesisSchedule::create($data);

        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit jadwal thesis yang ada.
     */
    public function edit(ThesisSchedule $thesisSchedule)
    {
        return view('admin.thesis_schedules.edit', compact('thesisSchedule'));
    }

    /**
     * Memperbarui data jadwal thesis di database.
     */
    public function update(Request $request, ThesisSchedule $thesisSchedule)
    {
        // 4. DIPERBARUI: Validasi URL dibuat lebih fleksibel
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string', // Diubah dari 'url' menjadi 'string'
            'order' => 'required|integer',
        ]);

        // 5. DIPERBARUI: Proses URL sebelum diperbarui
        $data = $request->all();
        $data['url'] = $this->prepareUrl($request->input('url'));
        
        $thesisSchedule->update($data);

        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule updated successfully.');
    }

    /**
     * Menghapus jadwal thesis dari database.
     */
    public function destroy(ThesisSchedule $thesisSchedule)
    {
        $thesisSchedule->delete();
        return redirect()->route('admin.thesis-schedules.index')->with('success', 'Thesis schedule deleted successfully.');
    }
}