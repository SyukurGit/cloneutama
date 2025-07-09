@props(['leaders'])

<section class="bg-white py-16 md:py-24">
    <div class="container mx-auto px-6">
        {{-- Judul Seksi --}}
        <div class="flex items-center mb-12">
            <span class="w-10 h-1 bg-red-600 rounded-full"></span>
            <h2 class="ml-4 text-3xl font-bold text-gray-800">Our Leadership</h2>
        </div>

        {{-- Grid Pimpinan --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @foreach ($leaders as $leader)
                <div class="text-center group">
                    {{-- Kontainer Gambar --}}
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $leader->image_path) }}" alt="{{ $leader->name }}" class="w-56 h-56 rounded-full object-cover shadow-lg mx-auto">
                        
                        {{-- Overlay Hover untuk Sosial Media (jika ada link) --}}
                        @if($leader->social_link)
                        <div class="absolute inset-0 rounded-full bg-gray-900 bg-opacity-0 group-hover:bg-opacity-70 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ $leader->social_link }}" target="_blank" class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/40 transform hover:scale-110 transition-transform">
                                
                                {{-- =============================================== --}}
                                {{-- KODE SVG YANG SUDAH DIPERBAIKI (IKON INSTAGRAM) --}}
                                {{-- =============================================== --}}
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.917 3.917 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.445.01 10.173 0 8 0zm0 1.442c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.282.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.282.11-.705.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.275-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.843-.038 1.096-.047 3.232-.047z"/>
                                    <path d="M8 4.202c-2.105 0-3.797 1.692-3.797 3.797s1.692 3.797 3.797 3.797 3.797-1.692 3.797-3.797S10.105 4.202 8 4.202zm0 6.153c-1.305 0-2.357-1.052-2.357-2.357S6.695 5.643 8 5.643 10.357 6.695 10.357 8s-1.052 2.357-2.357 2.357z"/>
                                    <path d="M12.601 2.898a1.442 1.442 0 1 1-2.884 0 1.442 1.442 0 0 1 2.884 0z"/>
                                </svg>

                            </a>
                        </div>
                        @endif
                    </div>
                    
                    <h3 class="mt-6 text-xl font-bold text-gray-900">{{ $leader->name }}</h3>
                    <p class="mt-1 text-gray-600">{{ $leader->position }}</p>
                </div>
            @endforeach

        </div>
    </div>
</section>