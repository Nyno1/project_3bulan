<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased transition-colors duration-300">

@include('profile.partials.navbar-user')

<!-- Hero Section -->
<main id="beranda" class="pt-20 pb-20 bg-white">
    <section class="relative w-full bg-gradient-to-r from-blue-50 via-white to-orange-50 py-20 overflow-hidden">
        <!-- Aksen Background -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-200 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-orange-200 rounded-full opacity-20 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6">
            <div class="space-y-6 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                    Selamat datang di 
                    <span class="text-orange-500">Certisat</span>
                </h1>
                <p class="text-gray-700 text-lg leading-relaxed max-w-lg mx-auto md:mx-0">
                    Website resmi pencarian <strong>sertifikat digital siswa</strong> dari kegiatan pelatihan, magang, 
                    dan kompetensi langsung oleh industri. Temukan bukti prestasimu hanya dengan NIS dan nama lengkap.
                </p>
                <a href="{{ route('pencarian.sertifikat') }}"
                class="inline-flex items-center gap-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-full shadow-md transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10A7 7 0 103 10a7 7 0 0014 0z" />
                    </svg>
                    Cari Sertifikat Sekarang
                </a>
            </div>

            <div class="relative flex justify-center md:justify-end">
                <div class="absolute -z-10 w-72 h-72 bg-orange-200 rounded-full opacity-30 top-10 right-10 blur-2xl"></div>
                <img src="{{ asset('images/Desian-Web.jpg') }}" alt="Ilustrasi Sertifikat"
                    class="w-80 md:w-96 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
            </div>
        </div>

        <svg class="absolute bottom-0 left-0 w-full h-16 text-white" preserveAspectRatio="none" viewBox="0 0 1440 320">
            <path fill="currentColor" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,149.3C672,160,768,128,864,112C960,96,1056,96,1152,122.7C1248,149,1344,203,1392,229.3L1440,256V320H0Z"></path>
        </svg>
    </section>

    <!-- Galeri -->
    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-blue-700">Galeri Kegiatan Sertifikasi</h2>
            <p class="text-gray-600 mt-2">Dokumentasi perjalanan siswa dalam meraih berbagai sertifikat dan prestasi</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $galeriItems = [
                    ['title' => 'Sertifikat Keunggulan Akademik', 'desc' => 'Prestasi akademik tahun 2024', 'img' => 'ke1.jpg'],
                    ['title' => 'Sertifikasi Komputer', 'desc' => 'Skill digital siswa', 'img' => 'ke2.jpg'],
                    ['title' => 'Pelatihan Bahasa Inggris', 'desc' => 'Sertifikasi internasional', 'img' => 'ke3.jpg'],
                    ['title' => 'Workshop Keterampilan', 'desc' => 'Sertifikat kompetensi vokasional', 'img' => 'ke4.jpg'],
                    ['title' => 'Sertifikasi Kepemimpinan', 'desc' => 'Leadership untuk OSIS & MPK', 'img' => 'ke5.jpg'],
                    ['title' => 'Magang Bersertifikat', 'desc' => 'Kerjasama industri', 'img' => 'ke6.jpg'],
                ];
            @endphp

            @foreach($galeriItems as $item)
                <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">
                    <div class="overflow-hidden">
                        <img src="{{ asset('images/' . $item['img']) }}" 
                            alt="{{ $item['title'] }}" 
                            class="w-full h-auto object-contain bg-gray-100">
                    </div>
                    <div class="p-5 space-y-3">
                        <span class="bg-gradient-to-r from-orange-500 to-red-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            SERTIFIKASI
                        </span>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-500 transition">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@include('profile.partials.footer')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        toggleButton?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('hidden');
        });
    });
</script>

</body>
</html>
