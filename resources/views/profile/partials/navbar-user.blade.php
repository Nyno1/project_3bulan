<nav 
    x-data="{ scrolled: false, open: false }" 
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-white/95 glass-effect border-b border-white/20 shadow-lg shadow-black/5' : 'bg-transparent'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-18">
            
            <!-- Logo -->
            <div class="flex items-center gap-3 logo-container">
                <img src="/images/logo.png" alt="Logo" class="relative w-auto h-10 lg:h-12">
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-1 lg:gap-2">
                <a href="/" class="nav-item px-4 py-2 text-sm lg:text-base font-medium transition-all duration-300"
                   :class="scrolled ? 'text-gray-700 hover:text-orange-500' : 'text-gray-700 hover:text-orange-300'">
                    <span class="relative z-10">Home</span>
                </a>
                <a href="{{ route('pencarian.sertifikat') }}" class="nav-item px-4 py-2 text-sm lg:text-base font-medium transition-all duration-300"
                   :class="scrolled ? 'text-gray-700 hover:text-orange-500' : 'text-gray-700 hover:text-orange-300'">
                    <span class="relative z-10">Cari Sertifikat</span>
                </a>
                
                <!-- Enhanced Login Button -->
                <div class="ml-4">
                    <a href="{{ route('login') }}" 
                       class="btn-primary relative inline-flex items-center justify-center px-5 py-2.5 lg:px-6 lg:py-3 text-sm lg:text-base font-semibold text-white rounded-xl shadow-lg shadow-orange-500/25 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-orange-500/40 group">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login Admin
                        </span>
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-orange-600 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </div>
            </div>

            <!-- Enhanced Mobile Menu Button -->
            <button 
                class="md:hidden relative w-10 h-10 rounded-lg bg-white/80 shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50" 
                @click="open = !open"
                :class="open ? 'hamburger-open' : ''"
            >
                <div class="absolute inset-0 flex flex-col justify-center items-center gap-1">
                    <span class="hamburger-line line1 w-5 h-0.5 bg-gray-600 rounded-full"></span>
                    <span class="hamburger-line line2 w-5 h-0.5 bg-gray-600 rounded-full"></span>
                    <span class="hamburger-line line3 w-5 h-0.5 bg-gray-600 rounded-full"></span>
                </div>
            </button>
        </div>
    </div>

    <!-- Enhanced Mobile Menu -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
        class="md:hidden bg-white/95 glass-effect border-t border-white/20 shadow-lg"
    >
        <div class="px-4 py-6 space-y-4">
            <a href="/" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-xl transition-all duration-300 group">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Beranda</span>
            </a>
            
            <a href="{{ route('pencarian.sertifikat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-xl transition-all duration-300 group">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Sertifikat</span>
            </a>
            
            <div class="pt-4 border-t border-gray-200">
                <a href="{{ route('login') }}" 
                   class="btn-primary w-full relative inline-flex items-center justify-center px-6 py-3 font-semibold text-white rounded-xl shadow-lg shadow-orange-500/25 transition-all duration-300 transform hover:scale-105 group">
                    <span class="relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login Admin
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>