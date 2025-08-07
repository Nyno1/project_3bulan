<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans transition-colors duration-300">

<!-- Navbar Baru -->
<header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700 shadow-sm transition">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo + Brand -->
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Logo" class="w-auto h-12 rounded-full">
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="#beranda" class="group text-gray-600 relative">Home
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('pencarian.sertifikat') }}" class="group text-gray-600 relative">Sertifikat
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('login') }}"
                   class="bg-orange-500 hover:bg-white hover:text-blue-800 text-white px-5 py-2 rounded-full font-semibold border border-white transition">
                   Login Admin
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden px-4 pb-4 hidden bg-white text-gray-800">
        <a href="#beranda" class="block py-2 hover:text-orange-300">Home</a>
        <a href="{{ route('pencarian.sertifikat') }}" class="block py-2 hover:text-orange-300">Sertifikat</a>
        <a href="{{ route('login') }}" class="block py-2 text-center bg-orange-500 rounded mt-2 hover:bg-white hover:text-blue-800 border border-white">Login Admin</a>
    </div>
</header>

<!-- Hero Section -->
<main id="beranda" class="pt-28 pb-20 px-4 transition-colors duration-300">
    <section class="bg-gradient-to-br from-blue-50 to-white py-24 px-6 rounded-lg overflow-hidden relative">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply blur-2xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-16 -right-10 w-80 h-80 bg-orange-200 rounded-full mix-blend-multiply blur-2xl opacity-30 animate-ping"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight mb-4">
                    Selamat datang di <span class="text-orange-500 underline underline-offset-4">Certisat</span>
                </h1>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Website resmi pencarian <strong>sertifikat digital siswa</strong> dari kegiatan pelatihan, magang, dan kompetensi langsung oleh industri. Temukan bukti prestasimu hanya dengan NIS dan nama lengkap.
                </p>
                <a href="{{ route('pencarian.sertifikat') }}"
                   class="mt-6 inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-full shadow-lg transition duration-300">
                    🔍 Cari Sertifikat Sekarang
                </a>
            </div>

            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('images/Desian-Web.jpg') }}" alt="Ilustrasi Sertifikat" class="w-80 md:w-96 animate-fade-in drop-shadow-xl">
            </div>
        </div>
    </section>

    <!-- Info Section Baru -->
    <section class="max-w-5xl mx-auto mt-24 text-center px-4">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">🎯 Apa itu Certisat?</h2>
        <p class="text-gray-600 text-lg">
            Certisat adalah sistem pencatatan dan publikasi sertifikat digital siswa SMK Informatika Pesat. Platform ini bertujuan mendukung transparansi, verifikasi, dan pengakuan atas pencapaian siswa secara terbuka dan mudah diakses.
        </p>
    </section>

    <!-- Galeri Tetap -->
    <section class="container mx-auto px-4 py-20">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Galeri Kegiatan Sertifikasi</h2>
        <p class="text-center text-gray-600 mb-10">Dokumentasi perjalanan siswa dalam meraih berbagai sertifikat dan prestasi</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition">
                    <img src="{{ asset('images/' . $item['img']) }}" alt="{{ $item['title'] }}" class="w-full max-h-60 object-contain bg-white rounded-t-lg">
                    <div class="p-4">
                        <span class="bg-orange-400 text-white text-xs font-semibold px-2 py-1 rounded">SERTIFIKASI</span>
                        <h3 class="mt-2 text-lg font-semibold text-gray-800">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>

@include('profile.partials.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        toggleButton?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('hidden');
        });
    });
</script>

</body>
</html>