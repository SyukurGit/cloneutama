<footer class="bg-footer-dark text-gray-400">
    {{-- Top Section: Logo & Contact --}}
    <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-10">
        <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left">
            {{-- Logo --}}
            <img src="{{ asset('images/logo.png') }}" alt="Postgraduate Logo" class="h-20 sm:h-24 w-auto mb-4 sm:mb-6 md:mb-0 md:mr-8 bg-white p-1 rounded shadow">
            
            {{-- Contact Info --}}
            <div class="text-sm w-full md:w-auto">
                <h3 class="text-white font-bold text-base sm:text-lg mb-3 sm:mb-4">GRADUATE SCHOOL AR-RANIRY STATE ISLAMIC UNIVERSITY</h3>
                <div class="flex items-start justify-center md:justify-start mb-2 sm:mb-3">
                    <span class="w-5 mr-2 mt-0.5 flex-shrink-0">📍</span>
                    <span class="text-left">Jl. Ar-Raniry No.1, KOPELMA, Syiah Kuala District, Banda Aceh City</span>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-2 sm:gap-x-4">
                    <div class="flex items-center mb-1"><span class="w-5 mr-2 flex-shrink-0">📞</span><span>0651-7776565</span></div>
                    <div class="flex items-center mb-1"><span class="w-5 mr-2 flex-shrink-0">📠</span><span>0651-7776565</span></div>
                    <div class="flex items-center mb-1"><span class="w-5 mr-2 flex-shrink-0">📧</span><a href="mailto:email@ar-raniry.ac.id" class="hover:text-white transition-colors">email@ar-raniry.ac.id</a></div>
                </div>
            </div>
        </div>
    </div>

    {{-- =============================================== --}}
    {{--    INI BAGIAN PEMISAH WARNA YANG DIPERBAIKI     --}}
    {{-- =============================================== --}}
    {{-- Divider Line with a slightly darker, semi-transparent background --}}
    <div class="bg-black bg-opacity-10">
        {{-- Bottom Section: Menu Links --}}
        <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                {{-- Column 1: Institutions --}}
                <div class="mb-6 sm:mb-0">
                    <h4 class="font-semibold text-white tracking-wider uppercase mb-3 sm:mb-4 text-sm">Institutions</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="http://lp2m.uin.ar-raniry.ac.id/" target="_blank" class="flex items-start gap-2 hover:text-white transition-colors"><span class="mt-1 flex-shrink-0">&gt;</span> <span>Institute for Research and Community Service (LP2M)</span></a></li>
                        <li><a href="http://lpm.uin.ar-raniry.ac.id/index.php/id" target="_blank" class="flex items-start gap-2 hover:text-white transition-colors"><span class="mt-1 flex-shrink-0">&gt;</span> <span>Institute for Quality Assurance (LPM)</span></a></li>
                    </ul>
                </div>

                {{-- Column 2: Service Units --}}
                <div class="mb-6 sm:mb-0">
                    <h4 class="font-semibold text-white tracking-wider uppercase mb-3 sm:mb-4 text-sm">Service Units</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://lib-pps.ar-raniry.ac.id/index.php?p=baca" target="_blank" class="hover:text-white transition-colors">○ Library</a></li>
                        <li><a href="https://ar-raniry.ac.id/unit-kerja/percetakan/" target="_blank" class="hover:text-white transition-colors">○ Printing and Publishing</a></li>
                        <li><a href="https://uin.ar-raniry.ac.id/index.php/id/pages/profil-pusat-bisnis-uin-ar-raniry" target="_blank" class="hover:text-white transition-colors">○ Business Development Centre</a></li>
                        <li><a href="https://uin.ar-raniry.ac.id/index.php/id/pages/pusat-pengembangan-bahasa" target="_blank" class="hover:text-white transition-colors">○ Language Development Centre</a></li>
                        <li><a href="https://mahad.ar-raniry.ac.id/" target="_blank" class="hover:text-white transition-colors">○ Ma'had Al Jamiah and Dormitory</a></li>
                        <li><a href="http://ict.uin.ar-raniry.ac.id/" target="_blank" class="hover:text-white transition-colors">○ Information Technology and Data Centre (PTIPD)</a></li>
                    </ul>
                </div>

                {{-- Column 3: Quick Links --}}
                <div class="mb-6 sm:mb-0">
                    <h4 class="font-semibold text-white tracking-wider uppercase mb-3 sm:mb-4 text-sm">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://uinarraniry.siakadcloud.com/siakad/home" target="_blank" class="hover:text-white transition-colors">○ SIAKAD</a></li>
                        <li><a href="https://opac.ar-raniry.ac.id/" target="_blank" class="hover:text-white transition-colors">○ OPAC</a></li>
                        <li><a href="https://repository.ar-raniry.ac.id/" target="_blank" class="hover:text-white transition-colors">○ Repository</a></li>
                        <li><a href="https://ar-raniry.ac.id/tentang-uinar/akreditasi/" target="_blank" class="hover:text-white transition-colors">○ Accreditation</a></li>
                    </ul>
                </div>

                {{-- Column 4: Students --}}
                <div class="mb-6 sm:mb-0">
                    <h4 class="font-semibold text-white tracking-wider uppercase mb-3 sm:mb-4 text-sm">Students</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">○ Academic Affairs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">○ Alumni Affairs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">○ International Services</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">○ Student Affairs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">○ Cooperation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">○ Public Relations & Protocol</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- =============================================== --}}
    {{--               AKHIR BAGIAN PEMISAH                --}}
    {{-- =============================================== --}}


    {{-- Copyright & Developer Credit --}}
    <div class="bg-black bg-opacity-20">
        <div class="container mx-auto px-4 sm:px-6 py-4 flex flex-col md:flex-row justify-between items-center text-sm">
            <p class="mb-4 md:mb-0 text-center md:text-left">&copy; {{ date('Y') }} Ar-Raniry Graduate School Program</p>
            <a href="https://github.com/SyukurGit" target="_blank" class="text-center hover:underline">
                &lt;&gt;  Web Developer Team
            </a>
        </div>
    </div>
</footer>

<!-- Tombol Scroll to Top (minimalis + kecil) -->
<a href="#" id="scrollToTopBtn"
   class="fixed bottom-5 right-5 z-50 h-9 w-9 flex items-center justify-center
          rounded-md border border-white/20 bg-white/5 text-white/80
          shadow-sm backdrop-blur-md
          opacity-0 translate-y-2 pointer-events-none
          transition-all duration-300 ease-out hover:scale-105"
   aria-label="Scroll to top">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
       fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <!-- double chevron up (minimalis) -->
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 16l6-6 6 6" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12l6-6 6 6" />
  </svg>
</a>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('scrollToTopBtn');

    // AKTIF (sedang scroll): merah solid & menonjol
    const activeClasses = [
      'bg-gradient-to-r','from-red-600','to-red-700','text-white',
      'ring-1','ring-white/20','shadow-lg',
      'opacity-100','translate-y-0','pointer-events-auto'
    ];

    // IDLE (berhenti scroll): tetap merah, tapi lebih transparan & subtle
    const idleOnClasses = [
      'bg-gradient-to-r','from-red-600','to-red-700','text-white',
      'ring-1','ring-white/10','shadow',
      'opacity-60','translate-y-0','pointer-events-auto'  // << atur transparansi di sini
    ];

    // Sembunyikan (di atas ambang)
    const hiddenClasses = ['opacity-0','translate-y-2','pointer-events-none'];

    let scrollTimer = null;
    const SHOW_AT = 200;       // muncul setelah 200px
    const IDLE_DELAY = 220;    // ms setelah berhenti scroll → idle

    function add(c) { btn.classList.add(...c); }
    function remove(c) { btn.classList.remove(...c); }

    function setHidden() {
      remove(activeClasses); remove(idleOnClasses); add(hiddenClasses);
    }
    function setIdle() {
      remove(activeClasses); remove(hiddenClasses); add(idleOnClasses);
    }
    function setActive() {
      remove(idleOnClasses); remove(hiddenClasses); add(activeClasses);
    }

    // State awal
    setHidden();

    // Toggle sesuai posisi & aktivitas scroll
    window.addEventListener('scroll', () => {
      const y = window.pageYOffset || document.documentElement.scrollTop;
      if (y > SHOW_AT) {
        setActive(); // sedang scroll → solid

        // setelah berhenti → idle (lebih transparan)
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => setIdle(), IDLE_DELAY);
      } else {
        setHidden();
      }
    }, { passive: true });

    // Aksi klik
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });
</script>
