<!-- Navbar Baru -->
<nav 
    x-data="{ scrolled: false, open: false }" 
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-white border-b border-gray-200 shadow-sm' : 'bg-transparent'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Logo" class="w-auto h-12 rounded-full">
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium"
                 :class="scrolled ? 'text-gray-700' : 'text-gray-700'">
                <a href="/" class="group relative">Home
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('pencarian.sertifikat') }}" class="group relative">Cari Sertifikat
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-300 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('login') }}" 
                   class="relative inline-flex items-center justify-center px-6 py-2 overflow-hidden font-semibold text-white rounded-full shadow-md transition-all duration-300 transform hover:scale-105 group">
                    <span class="absolute inset-0 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 bg-[length:200%_auto] animate-gradient"></span>
                    <span class="relative z-10">Login Admin</span>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden focus:outline-none" @click="open = !open"
                :class="scrolled ? 'text-gray-700' : 'text-white'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition 
         class="md:hidden px-4 pb-4 bg-white text-gray-800 border-t">
        <a href="/" class="block py-2 hover:text-orange-400">Beranda</a>
        <a href="{{ route('pencarian.sertifikat') }}" class="block py-2 hover:text-orange-400">Sertifikat</a>
        <a href="{{ route('login') }}" 
           class="mt-2 text-center relative inline-flex items-center justify-center px-6 py-2 overflow-hidden font-semibold text-white rounded-full shadow-md transition-all duration-300 transform hover:scale-105 group">
            <span class="absolute inset-0 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 bg-[length:200%_auto] animate-gradient"></span>
            <span class="relative z-10">Login Admin</span>
        </a>
    </div>
</nav>
