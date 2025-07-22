@php
    // Ambil data dari database. Gunakan cache untuk performa.
    $infoSection = \Illuminate\Support\Facades\Cache::remember('info_section', 3600, function () {
        return \App\Models\InfoSection::find(1);
    });
@endphp

@if($infoSection && $infoSection->is_active)
<section class="bg-white py-16 md:py-24">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="md:w-1/3 text-center md:text-left">
                <div class="relative inline-block">
                    <span class="absolute -top-4 -left-4 w-12 h-12 bg-red-200 rounded-full"></span>
                    <h2 class="relative text-3xl md:text-4xl font-bold text-gray-800 leading-tight">
                        {!! nl2br(e($infoSection->title)) !!}
                    </h2>
                </div>
            </div>
            <div class="md:w-2/3">
                <p class="text-xl md:text-2xl font-semibold text-red-600 mb-2">{{ $infoSection->slogan }}</p>
                <p class="text-gray-600 leading-relaxed">{{ $infoSection->content }}</p>
            </div>
        </div>
    </div>
</section>
@endif