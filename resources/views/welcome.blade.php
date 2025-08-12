<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        @keyframes floatY {
        0% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
        100% { transform: translateY(0); }
        }
        .animate-float { animation: floatY 6s ease-in-out infinite; }

        @keyframes gradientMove {
        0% { background-position: 0% 50%;}
        50% { background-position: 100% 50%;}
        100% { background-position: 0% 50%;}
        }
        .animate-gradient {
        background-size: 200% 200%;
        animation: gradientMove 4s ease infinite;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased transition-colors duration-300">

@include('profile.partials.navbar-user')

<!-- Hero Section -->
<main class="pt-20 pb-20 bg-white">
    <section id="beranda" class="relative w-full bg-gradient-to-r from-blue-50 via-white to-orange-50 pb-24 overflow-hidden" style="padding-top: calc(var(--navbar-height) + 2rem)">>
        <div class="absolute -top-28 -left-28 w-96 h-96 bg-blue-200 rounded-full opacity-30 blur-3xl animate-float"></div>
        <div class="absolute -bottom-28 -right-28 w-96 h-96 bg-orange-200 rounded-full opacity-30 blur-3xl animate-float" style="animation-delay: 1s;"></div>

        <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6">
            <div data-aos="fade-up" data-aos-delay="50">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                Selamat datang di <span class="text-orange-500">Certisat</span>
                </h1>
                <p class="text-gray-700 mt-4 max-w-lg">
                Platform pencarian dan verifikasi sertifikat digital siswa — cukup cari pakai <strong>NIS</strong> atau nama.
                </p>

                <div class="mt-6 flex items-center gap-4">
                <a href="{{ route('pencarian.sertifikat') }}"
                    class="inline-flex items-center gap-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-full shadow-md transition transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10A7 7 0 103 10a7 7 0 0014 0z" />
                    </svg>
                    Cari Sertifikat
                </a>
                </div>
            </div>

            <div class="flex justify-center md:justify-end" data-aos="fade-left" data-aos-delay="100">
                <img src="{{ asset('images/Desian-Web.jpg') }}" alt="Ilustrasi" class="w-80 md:w-96 rounded-xl shadow-xl transform hover:scale-105 transition animate-float">
                </div>
            </div>
        </div>

        <!-- wave -->
        <svg class="absolute bottom-0 left-0 w-full h-16 text-white" preserveAspectRatio="none" viewBox="0 0 1440 320">
            <path fill="currentColor" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,149.3C672,160,768,128,864,112C960,96,1056,96,1152,122.7C1248,149,1344,203,1392,229.3L1440,256V320H0Z"></path>
        </svg>
    </section>

    <!-- Galeri -->
    <section class="max-w-7xl mx-auto px-4 py-20" aria-label="Galeri">
        <div class="text-center mb-10" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-blue-700">Galeri Kegiatan Sertifikasi</h2>
        <p class="text-gray-600 mt-2">Dokumentasi kegiatan dan sertifikat siswa</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="80">
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
            <article class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden group transition hover:shadow-xl" data-aos="zoom-in" data-aos-delay="{{ 80 + $i*60 }}">
            <div class="overflow-hidden">
                <img src="{{ asset('images/' . $item['img']) }}" alt="{{ $item['title'] }}" class="w-full h-auto object-contain group-hover:scale-105 transition duration-500">
            </div>
            <div class="p-5">
                <span class="inline-block bg-gradient-to-r from-orange-500 to-red-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">SERTIFIKASI</span>
                <h3 class="mt-3 text-lg font-semibold text-gray-800">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $item['desc'] }}</p>
            </div>
            </article>
        @endforeach
        </div>
    </section>
</main>
@include('profile.partials.footer')

<!-- AOS -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        AOS.init({ duration: 700, once: true, offset: 60 });

        /* Mobile menu toggle */
        const btn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        btn?.addEventListener('click', () => menu?.classList.toggle('hidden'));

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
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navbar = document.getElementById("main-navbar");
            if (navbar) {
                const navHeight = navbar.offsetHeight;
                document.documentElement.style.setProperty("--navbar-height", `${navHeight}px`);
            }
        });
    </script>

</body>
</html>
