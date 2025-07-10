@php
    // Logika pengambilan data tetap sama
    $programsByLevel = \App\Models\StudyProgram::all()->groupBy('level');
@endphp

<style>
    /* KITA KEMBALIKAN STYLE GRADASI ASLI ANDA */
    .program-card {
        background: linear-gradient(135deg, #CA1819 0%, #DC2626 100%);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .program-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>

<section class="py-16 md:py-20">
    <div class="container mx-auto px-6 max-w-7xl">

        <div class="text-center mb-12 -mt-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                {{ __('db.study_programs.section_header') }}
            </h2>
        </div>
        
        {{-- Bagian Studi Doktor (S3) --}}
        @if(isset($programsByLevel['S3']) && $programsByLevel['S3']->isNotEmpty())
            <div class="mb-16">
                <div class="flex items-center mb-8">
                    <span class="w-12 h-1 bg-red-600 rounded-full"></span>
                    <h3 class="ml-4 text-2xl md:text-3xl font-medium text-gray-800">
                        {{ __('db.study_programs.doctor_title') }}
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($programsByLevel['S3'] as $program)
                        {{-- ========================================================== --}}
                        {{--           PERUBAHAN HANYA PADA KELAS CSS DI BAWAH          --}}
                        {{-- ========================================================== --}}
                        <a href="{{ $program->link }}" target="_blank" 
                           class="program-card text-white p-4 rounded-lg shadow-md no-underline flex flex-col justify-center">
                            <h4 class="text-base font-semibold">
                                {{ $program->name }}
                            </h4>
                            <p class="text-yellow-300 text-xs font-medium mt-1">
                                Accreditation: {{ $program->accreditation }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        
        {{-- Bagian Studi Magister (S2) --}}
        @if(isset($programsByLevel['S2']) && $programsByLevel['S2']->isNotEmpty())
            <div>
                <div class="flex items-center mb-8">
                    <span class="w-12 h-1 bg-red-600 rounded-full"></span>
                    <h3 class="ml-4 text-2xl md:text-3xl font-medium text-gray-800">
                        {{ __('db.study_programs.master_title') }}
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                     @foreach ($programsByLevel['S2'] as $program)
                        {{-- ========================================================== --}}
                        {{--           PERUBAHAN HANYA PADA KELAS CSS DI BAWAH          --}}
                        {{-- ========================================================== --}}
                        <a href="{{ $program->link }}" target="_blank"
                           class="program-card text-white p-4 rounded-lg shadow-md no-underline flex flex-col justify-center">
                            <h4 class="text-base font-semibold">
                                {{ $program->name }}
                            </h4>
                            <p class="text-yellow-300 text-xs font-medium mt-1">
                                Accreditation: {{ $program->accreditation }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>