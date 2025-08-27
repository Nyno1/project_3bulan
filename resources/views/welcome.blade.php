<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 font-sans antialiased transition-colors duration-300">

@include('profile.partials.navbar-user')

<main class="pb-20">
    <!-- Hero Section -->
    <section id="beranda" class="relative w-full min-h-screen bg-gradient-to-br from-blue-50 via-white to-orange-50 pb-24 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full opacity-20 animate-blob"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-gradient-to-br from-orange-400 to-red-500 rounded-full opacity-20 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-10 animate-blob" style="animation-delay: 4s;"></div>
        
        <!-- Floating particles -->
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6 pt-32">
            <div data-aos="fade-up" data-aos-delay="50">
                <h1 class="text-4xl md:text-6xl font-black leading-tight">
                    <span class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 bg-clip-text text-transparent">Selamat datang di</span>
                    <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent font-black"> Certisat</span>
                </h1>
                <p class="text-gray-700 text-lg mt-6 leading-relaxed max-w-lg">
                    Platform pencarian dan verifikasi sertifikat digital siswa — cukup cari pakai <strong class="text-blue-600">NIS</strong> atau nama.
                </p>

                <div class="mt-8 flex items-center gap-6">
                    <a href="{{ route('pencarian.sertifikat') }}"
                    class="btn-3d inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold px-8 py-4 rounded-full shadow-floating transition-all duration-300 shimmer-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10A7 7 0 103 10a7 7 0 0014 0z" />
                        </svg>
                        Cari Sertifikat
                    </a>
                </div>
            </div>

            <div class="flex justify-center md:justify-end" data-aos="fade-left" data-aos-delay="100">
                <div class="relative">
                    <!-- Background glow -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-orange-400 rounded-3xl blur-2xl opacity-30 animate-pulse-glow"></div>
                    
                    <img src="{{ asset('images/Desian-Web.jpg') }}" alt="Ilustrasi" 
                        class="relative w-80 md:w-96 rounded-3xl transform hover:scale-105 transition-all duration-500 animate-float bg-transparent drop-shadow-2xl"
                    >
                    
                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full animate-bounce opacity-80"></div>
                    <div class="absolute -bottom-6 -left-6 w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full animate-pulse opacity-60"></div>
                </div>
            </div>
        </div>

        <svg class="absolute bottom-0 left-0 w-full h-20" preserveAspectRatio="none" viewBox="0 0 1440 320">
            <defs>
                <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#ffffff;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path fill="url(#waveGradient)" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,149.3C672,160,768,128,864,112C960,96,1056,96,1152,122.7C1248,149,1344,203,1392,229.3L1440,256V320H0Z"></path>
        </svg>
        <div class="scroll-indicator"></div>
    </section>

    <!-- Gallery Section -->
    <section class="relative px-4 py-24" id="galeri" aria-label="Galeri">
        <!-- Background decoration -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500 rounded-full"></div>
            <div class="absolute bottom-20 right-10 w-16 h-16 bg-orange-500 rounded-full"></div>
            <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-purple-500 rounded-full transform -translate-x-1/2 -translate-y-1/2"></div>
        </div>

        <div class="relative z-10 text-center mb-16" data-aos="fade-up">
            <div class="inline-block relative">
                <h2 class="text-4xl md:text-5xl mb-2 font-black bg-gradient-to-r from-gray-800 via-blue-600 to-orange-500 bg-clip-text text-transparent">
                    Ikuti Kegiatan Terbaru
                </h2>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 to-orange-500 rounded-full"></div>
            </div>
            <p class="text-gray-600 text-lg mt-6 max-w-2xl mx-auto">
                Dokumentasi kegiatan dan sertifikat siswa dengan standar kualitas terbaik
            </p>
        </div>

        <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="80">
            @php
                $galeriItems = [
                    ['title'=>'Sertifikat Keunggulan Akademik','desc'=>'Prestasi akademik 2024','img'=>'ke1.jpg'],
                    ['title'=>'Sertifikasi Komputer','desc'=>'Skill digital siswa','img'=>'ke2.jpg'],
                    ['title'=>'Pelatihan Bahasa Inggris','desc'=>'Sertifikasi internasional','img'=>'ke3.jpg'],
                    ['title'=>'Workshop Keterampilan','desc'=>'Sertifikat kompetensi vokasional','img'=>'ke4.jpg'],
                    ['title'=>'Sertifikasi Kepemimpinan','desc'=>'Leadership OSIS & MPK','img'=>'ke5.jpg'],
                    ['title'=>'Magang Bersertifikat','desc'=>'Kerjasama industri','img'=>'ke6.jpg'],
                ];
            @endphp

            @foreach($galeriItems as $i => $item)
                <article class="relative group" data-aos="zoom-in" data-aos-delay="{{ 80 + $i*60 }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-400 to-orange-400 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition-all duration-500"></div>
                    
                    <!-- Main card -->
                    <div class="relative bg-white border border-gray-200 rounded-2xl shadow-floating overflow-hidden group-hover:shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <img src="{{ asset('images/' . $item['img']) }}" 
                                 alt="{{ $item['title'] }}" 
                                 class="w-full h-auto object-cover group-hover:scale-110 transition-all duration-700">
                            
                            <!-- Image overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Floating badge -->
                            <div class="absolute top-4 right-4 transform translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                                <span class="inline-block bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold px-3 py-2 rounded-full shadow-lg">
                                    SERTIFIKASI
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="relative p-6 bg-gradient-to-b from-white to-gray-50">
                            <!-- Decorative line -->
                            <div class="absolute top-0 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-blue-300 to-transparent"></div>
                            
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                                {{ $item['title'] }}
                            </h3>
                            <p class="text-gray-600 mt-3 leading-relaxed">
                                {{ $item['desc'] }}
                            </p>
                            
                            <!-- Bottom accent -->
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</main>

@include('profile.partials.footer')

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({ 
            duration: 700, 
            once: true, 
            offset: 60,
            easing: 'ease-out-cubic'
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', (e) => {
                const href = a.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const el = document.querySelector(href);
                    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
        
        // Parallax effect for background elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.animate-blob');
            parallaxElements.forEach((el, index) => {
                const speed = 0.5 + (index * 0.1);
                el.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    });

    // Enhanced navbar scroll effect
    document.addEventListener("scroll", () => {
        const navbar = document.getElementById("main-navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("bg-white/90", "backdrop-blur-lg", "shadow-xl", "border-b", "border-gray-200");
            navbar.classList.remove("bg-transparent");
        } else {
            navbar.classList.add("bg-transparent");
            navbar.classList.remove("bg-white/90", "backdrop-blur-lg", "shadow-xl", "border-b", "border-gray-200");
        }
    });

    // Set navbar height variable
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.getElementById("main-navbar");
        if (navbar) {
            const navHeight = navbar.offsetHeight;
            document.documentElement.style.setProperty("--navbar-height", `${navHeight}px`);
        }
    });
    
    // Interactive cursor effect (optional enhancement)
    document.addEventListener('mousemove', (e) => {
        const cursor = document.querySelector('.cursor-glow');
        if (!cursor) {
            const newCursor = document.createElement('div');
            newCursor.className = 'cursor-glow fixed w-8 h-8 bg-blue-400 rounded-full pointer-events-none mix-blend-multiply filter blur-xl opacity-70 z-50';
            newCursor.style.transform = 'translate(-50%, -50%)';
            document.body.appendChild(newCursor);
        }
        
        const cursorEl = document.querySelector('.cursor-glow');
        if (cursorEl) {
            cursorEl.style.left = e.clientX + 'px';
            cursorEl.style.top = e.clientY + 'px';
        }
    });
</script>

</body>
</html>