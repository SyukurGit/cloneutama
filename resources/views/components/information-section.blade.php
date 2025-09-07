@props(['informations'])

<section class="bg-gray-100 py-16 md:py-9">
    <div class="container mx-auto px-6">
        {{-- Judul Seksi --}}
        <div class="flex items-center mb-12">
            <span class="w-10 h-1 bg-red-600 rounded-full"></span>
            <h2 class="ml-4 text-3xl font-bold text-black">Information & Announcement</h2>
        </div>

        {{-- Daftar Informasi --}}
        <div class="space-y-4 max-w-4xl mx-auto">
            @forelse ($informations as $info)
                <div class="bg-white rounded-lg shadow-md p-4 flex items-center space-x-4 transition-all hover:shadow-xl ">
                    {{-- Thumbnail --}}
                    <div class="flex-shrink-0">
                        @if($info->thumbnail)
                            <img src="{{ asset('storage/' . $info->thumbnail) }}" alt="{{ $info->title }}" class="h-16 w-16 object-cover rounded-md">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded-md flex items-center justify-center">
                                <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Judul dan Label --}}
                    <div class="flex-grow">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $info->title }}</h3>
                        @if($info->label)
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-100">
                                {{ $info->label }}
                            </span>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex-shrink-0">
                        @if($info->type === 'link')
                            <a href="{{ $info->external_link }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors inline-flex items-center">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Donwload
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $info->file_path) }}" download class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors inline-flex items-center">
                                <i class="fas fa-download mr-2"></i>
                                Donwload
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">Belum ada informasi yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>