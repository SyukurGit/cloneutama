<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - {{ config('app.name') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar/>
    

    <main x-data="{ activeTab: 'greeting' }">
        {{-- Header dengan Latar Belakang --}}
        <div class="bg-gray-200 py-12">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-800">
                    {{-- Judul akan berubah sesuai tab aktif --}}
                    <span x-show="activeTab === 'greeting'">Director's Greeting</span>
                    <span x-show="activeTab === 'history'">History</span>
                    <span x-show="activeTab === 'vision'">Vision and Mission</span>
                    <span x-show="activeTab === 'directors'">Directorate</span>
                    <span x-show="activeTab === 'accreditation'">Accreditation</span>
                    <span x-show="activeTab === 'structure'">Organizational Structure</span>
                    <span x-show="activeTab === 'lecturers'">Experts and Homebase Lecturers</span>
                    <span x-show="activeTab === 'teaching_staff'">Educational Staff</span>
                    <span x-show="activeTab === 'facilities'">Graduate School Facilities</span>
                    <span x-show="activeTab === 'cooperation'">Collaboration</span>
                    {{-- Tambahkan span lain untuk judul tab lainnya --}}
                </h1>
                <p class="text-gray-600">Home / Profile / <span x-text="activeTab.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())"></span></p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- KOLOM KIRI: SIDEBAR MENU --}}
                <aside class="lg:col-span-1">
                    <div class="bg-red-700 rounded-lg p-6 text-white shadow-lg">
                        <h3 class="font-bold text-lg border-b border-red-500 pb-3 mb-4">Profile Menu</h3>
                        <ul class="space-y-1 text-sm">
                            {{-- Setiap link diubah untuk mengontrol Alpine.js --}}
                            <li><a href="#" @click.prevent="activeTab = 'greeting'" :class="{ 'bg-red-600 font-semibold': activeTab === 'greeting' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Director’s Welcome</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'history'" :class="{ 'bg-red-600 font-semibold': activeTab === 'history' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">History</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'vision'" :class="{ 'bg-red-600 font-semibold': activeTab === 'vision' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Vision and Mission</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'directors'" :class="{ 'bg-red-600 font-semibold': activeTab === 'directors' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Directorate</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'accreditation'" :class="{ 'bg-red-600 font-semibold': activeTab === 'accreditation' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Accreditation</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'structure'" :class="{ 'bg-red-600 font-semibold': activeTab === 'structure' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Organizational Structure</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'lecturers'" :class="{ 'bg-red-600 font-semibold': activeTab === 'lecturers' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Experts and Homebase Lecturers</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'teaching_staff'" :class="{ 'bg-red-600 font-semibold': activeTab === 'teaching_staff' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Educational Staff</a></li>
                            <li><a href="#" @click.prevent="activeTab = 'facilities'" :class="{ 'bg-red-600 font-semibold': activeTab === 'facilities' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Graduate School Facilities </a></li>
                            <li><a href="#" @click.prevent="activeTab = 'cooperation'" :class="{ 'bg-red-600 font-semibold': activeTab === 'cooperation' }" class="block px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Collaboration</a></li>
                        </ul>
                    </div>
                </aside>

               {{-- GANTI SELURUH DIV "KOLOM KANAN: KONTEN UTAMA" DENGAN INI --}}

{{-- KOLOM KANAN: KONTEN UTAMA --}}
<div class="lg:col-span-3">
    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 min-h-[400px]">
        
        {{-- KONTEN UNTUK SETIAP TAB --}}
        


        {{-- Director’s Welcome --}}
        <div x-show="activeTab === 'greeting'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Director’s Welcome</h2>
            <div class="prose max-w-none text-justify">
                <p class="font-semibold italic">Assalamualaikum Wr. Wb.</p>
                <p>Alhamdulillah, by expressing praise and gratitude for the presence of Allah SWT, welcome to the official website of the Graduate School, Ar-Raniry State Islamic University Banda Aceh. This website is designed as an information media for communication and publication platform that is accurate, transparent, and accountable to all visitors, both internal and external of the Graduate School community at Ar-Raniry State Islamic University. Through this website, we hope that Graduate School will become more widely recognized and provide easy access to information more quickly and efficiently. The information provided relates to academic programs, curriculum, teaching staff, human resources, student data, student activities, research, and other supporting infrastructure available.</p>
                <p>Finally, I would like to express my gratitude to all visitors who consistently access the various information provided on this website. Criticism and suggestions are certainly essential as a form of evaluation so that we can continue to improve and develop this platform to offer higher quality benefits to all parties involved.</p>
                <p class="font-semibold italic mt-6">Walaikumsalam Wr.Wb.</p>
                
                <div class="mt-8 border-t pt-4">
                    <p class="font-bold text-gray-900">Prof. Eka Srimulyani, MA., Ph.D</p>
                    <p class="text-sm text-gray-600">Director of Graduate School</p>
                </div>
            </div>
        </div>



     <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">History of the Graduate School</h2>
    <div class="prose max-w-none text-justify">
        <p>
            Before 2013, Ar-Raniry State Islamic University (UIN Ar-Raniry) was known as IAIN Ar-Raniry. The institute was officially established on <strong>October 5, 1963</strong>, becoming the third IAIN in Indonesia after those in Yogyakarta and Jakarta. The foundation of the Graduate School began in the 1978/1979 academic year through an initiative by the rector at the time, the late <strong>Prof. H. Ali Hasjmy</strong>, who opened a program called <i>Studi Purna Ulama</i> (SPU).
        </p>
        <p>
            The effort to enhance Islamic knowledge continued under the leadership of the late <strong>Prof. H. Ibrahim Husein, MA</strong>. With crucial moral and financial support from the Governor of Aceh Province, the late <strong>Prof. Dr. H. Ibrahim Hasan, MBA</strong>, the Graduate School of IAIN Ar-Raniry Banda Aceh was officially established in the <strong>1989/1990 academic year</strong>. Initially, it operated as a branch of the Graduate School of IAIN Syarif Hidayatullah Jakarta.
        </p>
        <p>
            In <strong>1997</strong>, through the Minister of Religious Affairs Decree No. 28, the Graduate School of IAIN Ar-Raniry gained standalone status. The journey continued in the <strong>2002/2003 academic year</strong> with the opening of a Doctoral (S3) Program in Modern Fiqh Studies, inaugurated by the Minister of Religious Affairs, <strong>Prof. Dr. Sayyid Agil Hussein Al-Munawwar, MA</strong>. Subsequently, in 2008, the Doctoral Program (S3) in Islamic Education was also established.
        </p>
        <p>
            A major milestone was reached on <strong>October 5, 2013</strong>, coinciding with its 50th anniversary. Through Presidential Regulation No. 64 of 2013, IAIN Ar-Raniry officially became <strong>Ar-Raniry State Islamic University (UIN Ar-Raniry)</strong>. Consequently, the graduate program was renamed the Graduate School of Ar-Raniry State Islamic University.
        </p>
        <p>
            In 2015, a significant transformation occurred as several concentrations were restructured into independent programs. This resulted in the establishment of 7 new Master’s Programs. Currently, the Graduate School of UIN Ar-Raniry Banda Aceh offers <strong>2 Doctoral Programs</strong> (Modern Fiqh Studies and Islamic Religious Education) and <strong>7 Master’s Programs</strong>, including Islamic Religious Studies, Family Law (Ahwal Syakhsiyyah), Sharia Economics, Islamic Religious Education, Arabic Language Education, Al-Qur’an and Tafsir Studies, and Islamic Communication and Broadcasting.
        </p>
    </div>
</div>

        <div x-show="activeTab === 'vision'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Vision and Mission</h2>
            <div class="prose max-w-none">
                <h3 class="font-bold text-lg text-gray-900">Vision</h3>
                <blockquote class="border-l-4 border-red-600 pl-4 italic text-gray-700">
                    “Becoming a modern, professional, and reliable Graduate School in developing integrative Islamic Sciences, nationalism, and university to build a godliness, moderate intelligent , and excellent society.”
                </blockquote>

                <h3 class="font-bold text-lg text-gray-900 mt-8">Mission</h3>
                <ol class="list-decimal list-inside space-y-3 mt-4 text-justify">
                    <li>To implement research-based learning that produces graduates who are intelligent, moral, spiritual, have skills and independence so that they can compete in the global era.</li>
                    <li>To develop integrative Islamic research that contributes to the development of science, the treasures of civilization both locally, nationally and internationally.</li>
                    <li>To develop moderate and humanist Islamic insights in the context of implementing Sharia Islam in Aceh.</li>
                    <li>To foster a paradigm of developing and planning the implementation of Islamic law in Aceh within the framework of the Republic of Indonesia’s National Unity (NKRI).</li>
                    <li>To establish cooperation and relationships with various parties in order to achieve the Tri Dharma of Higher Education.</li>
                </ol>
            </div>
        </div>

         <div x-show="activeTab === 'directors'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            @php
                // Ambil data pimpinan dari database
                $director = \App\Models\Leadership::where('order', 1)->first();
                $otherLeaders = \App\Models\Leadership::whereIn('order', [2, 3])->orderBy('order')->get();
            @endphp

            <h2 class="text-2xl font-bold text-gray-800 mb-8 border-b pb-3 text-center">Directors</h2>
            
            <div class="space-y-12">
                @if($director)
                <div class="flex flex-col items-center text-center">
                    <img src="{{ asset('storage/' . $director->image_path) }}" alt="{{ $director->name }}" class="w-48 h-48 rounded-full object-cover shadow-lg mb-4">
                    <h3 class="font-bold text-xl text-gray-900">{{ $director->name }}</h3>
                    <p class="text-red-600 font-semibold">{{ $director->position }}</p>
                </div>
                @endif

                @if($otherLeaders->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 pt-8 border-t">
                    @foreach($otherLeaders as $leader)
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('storage/' . $leader->image_path) }}" alt="{{ $leader->name }}" class="w-40 h-40 rounded-full object-cover shadow-lg mb-4">
                        <h3 class="font-bold text-lg text-gray-900">{{ $leader->name }}</h3>
                        <p class="text-gray-600">{{ $leader->position }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- fasilitas --}}
<div x-show="activeTab === 'facilities'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Graduate School Facilities</h2>

    {{-- Grid dinamis yang mengambil data dari controller --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($facilities as $facility)
            <div class="relative group">
                <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" class="w-full h-32 md:h-40 object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity duration-300 rounded-lg"></div>
                <div class="absolute bottom-0 left-0 p-2">
                    <h3 class="text-white text-xs md:text-sm font-semibold drop-shadow-md">{{ $facility->title }}</h3>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">
                Data fasilitas belum tersedia.
            </p>
        @endforelse
    </div>
</div>



{{-- akred --}}
 <div x-show="activeTab === 'accreditation'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Accreditation</h2>
            <div class="prose max-w-none text-justify">
                <p>The Graduate School of Ar-Raniry State Islamic University is committed to maintaining the highest standards of academic quality. All of our study programs are fully accredited by the National Accreditation Board for Higher Education (BAN-PT). This ensures that our curriculum, teaching staff, and facilities meet rigorous national standards.</p>
                <a href="https://pps.ar-raniry.ac.id/profil/akreditasi/" target="_blank" class="inline-block mt-4 bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors no-underline">
                    Read More &rarr;
                </a>
            </div>
        </div>

{{-- struktur --}}
        <div x-show="activeTab === 'structure'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Organizational Structure</h2>
            <div class="prose max-w-none text-justify">
                <p>Our organizational structure is designed to support our academic and administrative functions effectively. Led by the Director and supported by a team of dedicated professionals, the structure ensures a clear line of command and efficient service delivery for students, faculty, and stakeholders.</p>
                 <a href="https://pps.ar-raniry.ac.id/profil/struktur-organisasi/" target="_blank" class="inline-block mt-4 bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors no-underline">
                    View Structure Chart &rarr;
                </a>
            </div>
        </div>

        {{-- lecture --}}
        <div x-show="activeTab === 'lecturers'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Experts and Homebase Lecturers</h2>
            <div class="prose max-w-none text-justify">
                <p>We are proud to have a team of highly qualified lecturers and professional staff. Our academics are experts in their respective fields with extensive research and teaching experience, while our administrative staff are dedicated to providing excellent service and support to our academic community.</p>
                 <a href="https://pps.ar-raniry.ac.id/profil/dosen-pengajar/" target="_blank" class="inline-block mt-4 bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors no-underline">
                    See Full Directory &rarr;
                </a>
            </div>
        </div>

        {{-- staf --}}
        <div x-show="activeTab === 'teaching_staff'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Educational Staff</h2>
            <div class="prose max-w-none text-justify">
                <p>Our teaching staff consists of distinguished scholars and practitioners who are committed to academic excellence. They bring a wealth of knowledge and real-world experience to the classroom, fostering an engaging and intellectually stimulating learning environment for all our graduate students.</p>
                 <a href="https://pps.ar-raniry.ac.id/profil/tenaga-kependidikan/" target="_blank" class="inline-block mt-4 bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors no-underline">
                    View Educational Staff Profiles &rarr;
                </a>
            </div>
        </div>


        {{-- kerjasama --}}
        <div x-show="activeTab === 'cooperation'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Collaboration</h2>
            <div class="prose max-w-none text-justify">
                <p>The Graduate School actively engages in national and international cooperation with various universities, research institutions, and government bodies. These partnerships enhance our research capabilities, provide global opportunities for our students and faculty, and strengthen our contribution to society.</p>
                 <a href="https://pps.ar-raniry.ac.id/profil/kerjasama/" target="_blank" class="inline-block mt-4 bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors no-underline">
                    Explore Our Partnerships &rarr;
                </a>
            </div>
        </div>




















        

        {{-- Tambahkan div lain dengan x-show untuk setiap menu lainnya di sini --}}

    </div>
</div>





            </div>
        </div>
    </main>
    
    <x-footer/>

</body>
</html>