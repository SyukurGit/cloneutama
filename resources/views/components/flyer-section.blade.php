@props(['flyers'])

@if($flyers->isNotEmpty())
<section class="bg-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center mb-12">
            <span class="w-10 h-1 bg-red-600 rounded-full"></span>
            <h2 class="ml-4 text-3xl font-bold text-black">Innovation & Creativity</h2>
        </div>

        <div 
            x-data="{
                activeIndex: 0,
                previewImage: '',
                showPreview: false,
                total: {{ $flyers->count() }},
                // Slides per view (responsif). LG dibuat 3 agar pas tengah jika total = 3
                spv() {
                    if (window.innerWidth >= 1024) return 3;   // lg
                    if (window.innerWidth >= 768) return 3;    // md
                    return 1;                                  // mobile
                },
                pages() {
                    return Math.max(1, Math.ceil(this.total / this.spv()));
                },
                goNext() {
                    this.activeIndex = (this.activeIndex + 1) % this.pages();
                },
                goPrev() {
                    this.activeIndex = (this.activeIndex - 1 + this.pages()) % this.pages();
                }
            }"
            x-init="$watch('activeIndex', () => {}); window.addEventListener('resize', () => { activeIndex = Math.min(activeIndex, pages()-1) })"
            class="relative max-w-7xl mx-auto"
        >

            <!-- TRACK -->
            <div class="overflow-hidden rounded-xl">
                <div
                    class="flex transition-transform duration-500 ease-in-out"
                    :class="{'justify-center': total <= spv()}" 
                    :style="pages() > 1 ? ('transform: translateX(-' + (activeIndex * (100 / spv())) + '%)') : ''"
                >
                    @foreach ($flyers as $flyer)
                        <!-- SLIDE -->
                        <div class="flex-shrink-0 basis-full md:basis-1/3 lg:basis-1/3 p-5">
                            <div class="group relative rounded-2xl bg-white shadow-lg ring-1 ring-black/5 overflow-hidden hover:shadow-xl transition">
                                <div class="w-full aspect-square overflow-hidden bg-gray-100">
                                    <img
                                        src="{{ Storage::url($flyer->image_path) }}"
                                        alt="{{ $flyer->title }}"
                                        class="w-full h-full object-cover cursor-pointer"
                                        @dblclick="showPreview = true; previewImage = '{{ Storage::url($flyer->image_path) }}'"
                                    >
                                </div>
                                <!-- overlay title -->
                                <div class="pointer-events-none absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                                    <div class="mb-3 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-gray-800">
                                        {{ $flyer->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- NAV BUTTONS (mobile only) -->
            <button
                @click="goPrev()"
                class="flex md:hidden absolute left-3 top-1/2 -translate-y-1/2 h-10 w-10 items-center justify-center rounded-full bg-white/80 hover:bg-white shadow-md ring-1 ring-black/5"
                aria-label="Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button
                @click="goNext()"
                class="flex md:hidden absolute right-3 top-1/2 -translate-y-1/2 h-10 w-10 items-center justify-center rounded-full bg-white/80 hover:bg-white shadow-md ring-1 ring-black/5"
                aria-label="Berikutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- DOTS (sembunyikan kalau hanya 1 halaman) -->
            <div class="mt-6 flex justify-center gap-2" x-show="pages() > 1">
                <template x-for="i in pages()" :key="i">
                    <button
                        @click="activeIndex = i-1"
                        class="h-2.5 w-2.5 rounded-full"
                        :class="activeIndex === (i-1) ? 'bg-gray-800' : 'bg-gray-300'"></button>
                </template>
            </div>

            <!-- PREVIEW MODAL -->
            <div x-show="showPreview"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                 style="display: none;">
                <div class="relative max-w-4xl max-h-full" @click.away="showPreview = false">
                    <img :src="previewImage" alt="Flyer Preview" class="w-auto h-auto max-w-full max-h-[90vh] rounded-lg shadow-2xl">
                    <button @click="showPreview = false"
                            class="absolute -top-4 -right-4 bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
