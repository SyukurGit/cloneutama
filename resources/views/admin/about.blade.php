@extends('layouts.admin')

@section('title', 'Tentang Panel Admin')
@section('header', 'Panduan dan Informasi Panel Admin')

@section('content')
<div class="space-y-8">

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-book-open fa-lg text-red-600"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Selamat Datang di Panduan Panel Admin</h2>
                <p class="mt-1 text-gray-600">Halaman ini berisi dokumentasi dan panduan teknis mengenai cara kerja fitur-fitur utama di dalam sistem ini.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-3">
            <i class="fas fa-info text-red-600"></i>
            Tentang situs Ini
        </h3>
        <div class="space-y-4 text-gray-700 text-sm leading-relaxed">
            <p>Web ini hanya khusus mengelola situs pasca uin yang versi bahasa inggris , di buat dengan Laravel 11 dengan styling tailwind css dan database Mysql.</p>
            <ul class="list-disc list-inside space-y-2 pl-2">
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
    <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-3">
        <i class="fas fa-key text-red-600"></i>
        Manajemen Akun Superadmin via Tinker
    </h3>
    <div class="space-y-6 text-gray-700 text-sm leading-relaxed">

        <div>
            <h4 class="font-bold text-gray-800 mb-2">1. Cara Reset Password Superadmin</h4>
            <p class="mb-2">Jika seorang Superadmin lupa kata sandinya, reset hanya bisa dilakukan secara manual melalui terminal di server menggunakan Laravel Tinker. Ini adalah cara yang aman dan cepat.</p>
            <ol class="list-decimal list-inside space-y-2 pl-2">
                <li>Buka terminal di direktori root proyek Laravel Anda.</li>
                <li>Jalankan perintah untuk masuk ke mode Tinker:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">php artisan tinker</code>
                </li>
                <li>Cari user berdasarkan email. Ganti <code class="text-red-400">'admin@webkampus.com'</code> dengan email superadmin yang relevan:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">$user = \App\Models\User::where('email', 'admin@webkampus.com')->first();</code>
                </li>
                <li>Setelah user ditemukan, set password baru. Ganti <code class="text-red-400">'password_baru_yang_aman'</code> dengan password pilihan Anda:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">$user->password = Illuminate\Support\Facades\Hash::make('password_baru_yang_aman');</code>
                </li>
                <li>Simpan perubahan ke database:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">$user->save();</code>
                </li>
                <li>Keluar dari Tinker dengan mengetik <code class="text-red-400">exit</code>.</li>
            </ol>
        </div>

        <div>
            <h4 class="font-bold text-gray-800 mb-2 mt-4">2. Cara Tambah Akun Superadmin Baru</h4>
            <p class="mb-2">Jika diperlukan, Anda juga bisa membuat akun Superadmin baru langsung dari terminal. Ini berguna jika tidak ada satupun akun Superadmin yang bisa diakses.</p>
            <ol class="list-decimal list-inside space-y-2 pl-2">
                 <li>Masuk ke mode Tinker seperti pada langkah di atas:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">php artisan tinker</code>
                </li>
                <li>Buat user baru dengan data yang diinginkan:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">
                        $user = new \App\Models\User;<br>
                        $user->name = 'Nama Superadmin Baru';<br>
                        $user->email = 'emailbaru@webkampus.com';<br>
                        $user->password = Illuminate\Support\Facades\Hash::make('password_baru_yang_aman');<br>
                        $user->role = 'superadmin';
                    </code>
                </li>
                <li>Simpan user baru tersebut ke database:
                    <code class="block bg-gray-900 text-white text-xs font-mono rounded-md p-3 my-2 select-all">$user->save();</code>
                </li>
                <li>Akun baru sudah berhasil dibuat. Keluar dari Tinker dengan <code class="text-red-400">exit</code>.</li>
            </ol>
        </div>

        <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 rounded-r-lg">
            <p><i class="fas fa-exclamation-triangle mr-2"></i><strong>Penting:</strong> Tindakan ini hanya boleh dilakukan oleh developer atau seseorang dengan akses ke server. Pastikan password baru yang digunakan kuat dan aman.</p>
        </div>
    </div>
</div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-3">
            <i class="fas fa-tags text-red-600"></i>
            Logika Sistem Tagging Berita
        </h3>
        <div class="space-y-4 text-gray-700 text-sm leading-relaxed">
            <p>Untuk memudahkan pengelolaan, sistem tagging berita memiliki logika khusus untuk memastikan setiap berita memiliki setidaknya satu kategori.</p>
            <ul class="list-disc list-inside space-y-2 pl-2">
                <li>Jika admin **tidak memilih satupun kategori** saat membuat atau mengedit berita, sistem akan secara otomatis menetapkan tag default, yaitu <strong class="font-semibold text-gray-800">#Postgraduate</strong>.</li>
                <li>Jika admin **memilih satu atau lebih kategori** (misalnya: #Islamic_Economics), maka tag #Postgraduate <strong class="font-semibold text-red-600">TIDAK AKAN</strong> ditambahkan secara otomatis.</li>
                <li>Admin tetap bisa memilih tag #Postgraduate secara manual bersamaan dengan tag lainnya jika memang relevan.</li>
            </ul>
            <p>Logika ini diimplementasikan di dalam method <code class="bg-gray-200 text-xs px-1.5 py-0.5 rounded">store()</code> dan <code class="bg-gray-200 text-xs px-1.5 py-0.5 rounded">update()</code> pada file <code class="bg-gray-200 text-xs px-1.5 py-0.5 rounded">app/Http/Controllers/Admin/NewsController.php</code>.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-3">
            <i class="fas fa-code text-red-600"></i>
            Kredit Developer
        </h3>
        <div class="text-gray-700 text-sm">
            <p>Website dan Panel Admin ini hanya dikembangkan oleh : 
                <a href="https://github.com/SyukurGit" target="_blank" class="font-bold text-red-600 hover:underline">Syukur (Teknologi Informasi 22)</a>.
            </p>
            <p class="mt-1">Jika anda menemukan Bug atau pertanyaan teknis lebih lanjut, silakan hubungi developer.</p>
        </div>
    </div>
    </div>
@endsection