<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans transition-colors duration-300">

<!-- Navbar -->
<header class="fixed top-0 left-0 w-full z-50 bg-blue-900/80 backdrop-blur-md shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <h1 class="text-xl font-bold text-white">SMK Informatika Pesat</h1>
            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="/" class="relative text-white hover:text-orange-300 transition group">
                    Home
                    <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="" class="relative text-white hover:text-orange-300 transition group">
                    Sertifikat
                    <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('login') }}"
                   class="px-4 py-1.5 rounded bg-white/20 border border-white text-white hover:bg-white hover:text-blue-700 transition font-semibold text-sm">
                   Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-1.5 rounded bg-orange-400 text-white hover:bg-orange-500 transition font-semibold text-sm">
                   Register
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden px-4 pb-4 hidden bg-blue-700">
        <a href="#" class="block py-2 text-white hover:text-orange-300">Home</a>
        <a href="#" class="block py-2 text-white hover:text-orange-300">Sertifikat</a>
        <a href="{{ route('login') }}"
           class="block w-full text-center py-2 mt-2 bg-white/20 border border-white text-white hover:bg-white hover:text-blue-600 transition rounded">
            Login
        </a>
        <a href="{{ route('register') }}"
           class="block w-full text-center py-2 mt-2 bg-orange-400 text-white hover:bg-orange-500 transition rounded">
            Register
        </a>
    </div>
</header>

<section class="bg-white py-12 pt-28 px-4 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h3 class="text-center text-2xl font-semibold text-gray-800 mb-8">
            Cari Sertifikat Siswa
        </h3>

        <!-- Filter Tabs -->
        <div class="flex justify-center gap-4 mb-6">
            <button class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-blue-100 focus:bg-blue-600 focus:text-white transition font-medium">
                <i class="fas fa-user mr-2"></i> Nama Siswa
            </button>
            <button class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-blue-100 focus:bg-blue-600 focus:text-white transition font-medium">
                <i class="fas fa-id-card mr-2"></i> NIS
            </button>
        </div>

        <!-- Input dan Button -->
        <div class="flex justify-center gap-2 max-w-xl mx-auto">
            <div class="relative w-full">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input
                    type="text"
                    placeholder="cari berdasarkan nama atau nis"
                    class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2 rounded-md hover:from-blue-700 hover:to-blue-800 transition">
                <i class="fas fa-search mr-1"></i> Cari
            </button>
        </div>
    </div>
</section>

</body>
</html>