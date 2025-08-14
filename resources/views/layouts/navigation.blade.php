<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700 shadow-sm transition">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="/images/Logo.png" alt="logo pesat" class="h-12 w-auto">
                </a>
            </div>

            <!-- Menu -->
            <div class="hidden sm:flex items-center space-x-6">
                <!-- Navigasi Umum -->
                <div class="flex items-center space-x-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Beranda</x-nav-link>
                    <x-nav-link :href="route('tambah.sertifikat')" :active="request()->routeIs('tambah.sertifikat')">Tambah Sertifikat</x-nav-link>
                    <x-nav-link :href="route('sertifikat.import.form')" :active="request()->routeIs('sertifikat.import.form')">Import Sertifikat</x-nav-link>
                    <x-nav-link :href="route('sertifikat.upload')" :active="request()->routeIs('sertifikat.upload')">Upload Sertifikat</x-nav-link>
                </div>

                <!-- Divider Visual -->
                <div class="h-6 w-px bg-gray-300 dark:bg-gray-600 mx-2"></div>

                <!-- Profil Admin -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden bg-white/90 backdrop-blur dark:bg-gray-900/90">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Beranda</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tambah.sertifikat')" :active="request()->routeIs('tambah.sertifikat')">Tambah Sertifikat</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sertifikat.import.form')" :active="request()->routeIs('sertifikat.import.form')">Import Sertifikat</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sertifikat.upload')" :active="request()->routeIs('sertifikat.upload')">Upload Sertifikat</x-responsive-nav-link>
        </div>

        <!-- Admin Profil Mobile -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
