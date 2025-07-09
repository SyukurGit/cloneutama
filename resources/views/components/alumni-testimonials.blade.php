@props(['testimonials'])

@if($testimonials->isNotEmpty())
<section class="bg-red-700 py-16 md:py-24">
    <div 
        class="container mx-auto px-6"
        x-data="{
            activeSlide: 0,
            totalSlides: {{ $testimonials->count() }},
            autoplay() {
                if (this.totalSlides > 1) {
                    setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                    }, 5000);
                }
            }
        }"
        x-init="autoplay()"
    >
        {{-- Judul Seksi --}}
        <div class="flex items-center mb-12">
            <span class="w-10 h-1 bg-yellow-400 rounded-full"></span>
            <h2 class="ml-4 text-3xl font-bold text-white">{{ __('db.alumni_testimonials.section_title') }}</h2>
        </div>

        {{-- Kontainer Carousel --}}
        <div class="relative h-80 md:h-64">
            @foreach ($testimonials as $index => $testimonial)
                <div 
                    x-show="activeSlide === {{ $index }}"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform -translate-x-8"
                    class="absolute inset-0"
                >
                    {{-- Wrapper untuk link opsional --}}
                    <a href="{{ $testimonial->link ?? '#' }}" @if($testimonial->link) target="_blank" @endif class="block h-full no-underline">
                        <div class="bg-white p-8 rounded-lg shadow-xl h-full flex flex-col justify-between relative">
                            <div>
                                <div class="flex items-center text-yellow-400 mb-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600 italic">"{{ $testimonial->quote }}"</p>
                            </div>
                            <div class="flex items-center mt-6 pt-6 border-t border-gray-200">
                                <div class="w-12 h-12 rounded-full flex-shrink-0 mr-4">
                                    <img src="{{ asset('storage/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover rounded-full">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">{{ $testimonial->name }}</p>
                                    <p class="text-sm text-gray-500">UIN Ar-Raniry Postgraduate</p>
                                </div>
                            </div>
                            <div class="absolute right-8 bottom-8 text-8xl text-gray-100 font-serif">”</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif