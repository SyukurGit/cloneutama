<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    /**
     * Membuat dan mengunduh file backup database.
     */
    public function downloadDatabase()
    {
        // Pastikan hanya Super Admin yang bisa mengakses
        Gate::authorize('isSuperAdmin');

        try {
            // Ambil konfigurasi database dari file .env
            $dbName = config('database.connections.mysql.database');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbHost = config('database.connections.mysql.host');
            
            // Buat nama file yang unik dengan tanggal
            $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
            $filePath = storage_path('app/' . $fileName);

            // Bangun perintah mysqldump
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbHost),
                escapeshellarg($dbName),
                escapeshellarg($filePath)
            );
            
            // Jalankan perintah menggunakan Symfony Process
            $process = Process::fromShellCommandline($command);
            $process->run();

            // Jika proses gagal, lempar exception
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            
            // Kirim file sebagai unduhan, dan hapus file setelahnya
            return response()->download($filePath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            // Jika terjadi error, kembali dengan pesan
            return redirect()->back()->with('error', 'Gagal membuat backup database: ' . $e->getMessage());
        }
    }
}