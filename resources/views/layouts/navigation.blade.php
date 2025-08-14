<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav x-data="{ open: false }" class="border-b border-gray-200">
    <!-- Tombol toggle sidebar (mobile) -->
    <button
        data-drawer-target="default-sidebar"
        data-drawer-toggle="default-sidebar"
        aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-700 rounded-lg sm:hidden
               hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300"
    >
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside
        x-data="{
            open: JSON.parse(localStorage.getItem('sidebarOpen') || 'false'),
            setOpen(value) {
                this.open = value;
                localStorage.setItem('sidebarOpen', value);
                window.dispatchEvent(new Event('sidebar-toggled'));
            }
        }"
        @mouseenter="setOpen(true)"
        @mouseleave="setOpen(false)"
        :class="open ? 'w-64' : 'w-16'"
        class="fixed top-0 left-0 h-screen bg-white/80 backdrop-blur-lg text-gray-800 transition-all duration-300 shadow-lg"
    >
        <div class="flex flex-col h-full border-r border-gray-200 overflow-y-auto py-5 px-3">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-16">
                <h1 class="flex items-center font-bold text-gray-800 space-x-3">
                    <div class="bg-white rounded-full p-1 shadow-md">
                        <img src="/images/logo.png" alt="Logo" class="w-15 h-8">
                    </div>
                    <span x-show="open">Sertifikat Digital</span>
                </h1>
            </div>

            <!-- Menu -->
            <ul class="space-y-2 flex-grow mt-4">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center p-2 text-base font-medium rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        <ion-icon name="home" class="w-6 h-6 text-blue-500"></ion-icon>
                        <span x-show="open" class="ml-3">Beranda</span>
                    </a>
                </li>

                <div class="my-2 h-px w-full bg-gray-300/50"></div>

                @if (auth()->user()->role == 'admin')
                    <li x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" type="button"
                            class="flex items-center p-2 w-full text-base font-medium rounded-lg hover:bg-gray-100 transition">
                            <ion-icon name="document-text" class="w-6 h-6 text-blue-500"></ion-icon>
                            <span x-show="open" class="ml-3">Manajemen</span>
                            <svg x-show="open" aria-hidden="true"
                                 class="w-6 h-6 text-gray-600 ml-auto transform transition-transform duration-300"
                                 :class="openDropdown ? 'rotate-180' : ''"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul x-show="open && openDropdown" x-transition class="py-2 space-y-2">
                            <li>
                                <a href="{{ route('tambah.sertifikat') }}" 
                                   class="flex items-center p-2 pl-11 text-base font-medium rounded-lg hover:bg-gray-100 transition">
                                    Data Siswa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sertifikat.import.form') }}" 
                                   class="flex items-center p-2 pl-11 text-base font-medium rounded-lg hover:bg-gray-100 transition">
                                    Import Excel
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sertifikat.upload') }}" 
                                   class="flex items-center p-2 pl-11 text-base font-medium rounded-lg hover:bg-gray-100 transition">
                                    Upload Sertifikat
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Profil & Logout -->
            <div class="mt-auto border-t border-gray-300">
                <!-- Profil (hanya muncul saat sidebar terbuka) -->
                <div x-show="open" class="flex items-center space-x-3 p-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                        alt="Profile"
                        class="w-10 h-10 rounded-full shadow-sm border border-gray-200">
                    <div>
                        <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">Role: {{ Auth::user()->role }}</div>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}"
                    class="p-4 border-t border-gray-300 flex justify-center">
                    @csrf
                    <button type="submit"
                        :class="open ? 'w-full justify-start px-4' : 'w-10 h-10 justify-center'"
                        class="flex items-center rounded-lg text-red-500 hover:bg-red-100 transition">
                        <ion-icon name="log-out-outline" class="w-5 h-5"></ion-icon>
                        <span x-show="open" class="ml-2 text-sm font-medium">Log Out</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>
</nav>
