@props(['flyers'])

@if($flyers->isNotEmpty())
<section class="bg-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight sm:text-4xl">
                Informasi & Pengumuman
            </h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Pengumuman terbaru seputar kegiatan akademik dan kemahasiswaan.
            </p>
        </div>

        <div x-data="{ 
            activeIndex: 0, 
            showPreview: false, 
            previewImage: '' 
        }">

            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($flyers as $flyer)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                        <img src="{{ Storage::url($flyer->image_path) }}" 
                             alt="{{ $flyer->title }}" 
                             class="w-full h-full object-cover aspect-square cursor-pointer"
                             @dblclick="showPreview = true; previewImage = '{{ Storage::url($flyer->image_path) }}'">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-search-plus text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="md:hidden relative">
                <div class="relative w-full overflow-hidden rounded-lg shadow-lg">
                    <div x-ref="carousel" class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + activeIndex * 100 + '%)'">
                        @foreach ($flyers as $flyer)
                            <div class="w-full flex-shrink-0">
                                <img src="{{ Storage::url($flyer->image_path) }}" 
                                     alt="{{ $flyer->title }}" 
                                     class="w-full object-cover aspect-square"
                                     @dblclick="showPreview = true; previewImage = '{{ Storage::url($flyer->image_path) }}'">
                            </div>
                        @endforeach
                    </div>
                </div>

                <button @click="activeIndex = (activeIndex > 0) ? activeIndex - 1 : {{ $flyers->count() - 1 }}" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 text-gray-800 shadow-md focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button @click="activeIndex = (activeIndex < {{ $flyers->count() - 1 }}) ? activeIndex + 1 : 0" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 text-gray-800 shadow-md focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>

            <div x-show="showPreview" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 p-4"
                 style="display: none;">

                <div class="relative max-w-4xl max-h-full" @click.away="showPreview = false">
                    <img :src="previewImage" alt="Flyer Preview" class="w-auto h-auto max-w-full max-h-[90vh] rounded-lg shadow-2xl">
                    <button @click="showPreview = false" class="absolute -top-4 -right-4 bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif