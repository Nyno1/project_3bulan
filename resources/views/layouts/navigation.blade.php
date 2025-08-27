<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav x-data="{ open: false }" class="relative z-50">
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
        class="fixed top-0 left-0 h-screen bg-white/95 backdrop-blur-xl text-gray-800 transition-all duration-300 shadow-2xl border-r border-gray-200/50 z-40"
    >
        <!-- Gradient overlay for modern look -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/95 via-slate-50/90 to-gray-100/80 backdrop-blur-xl"></div>
        
        <!-- Subtle animated background -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 -left-10 w-32 h-32 bg-gradient-to-br from-blue-200/20 to-indigo-300/20 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute bottom-40 -right-10 w-40 h-40 bg-gradient-to-br from-purple-200/20 to-pink-300/20 rounded-full blur-2xl animate-pulse delay-1000"></div>
        </div>

        <div class="relative z-10 flex flex-col h-full overflow-y-auto py-6 px-4">
            
            <!-- Logo Section -->
            <div class="flex items-center justify-center h-16 mb-8">
                <div class="flex items-center space-x-3 group">
                    <div class="relative">
                            <img src="/images/logo.png" alt="Logo" class="w-12 h-8">
                    </div>
                    <div x-show="open" x-transition class="overflow-hidden">
                        <h1 class="font-bold text-gray-800 text-lg">
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Sertifikat Digital
                            </span>
                        </h1>
                        <p class="text-xs text-gray-500">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <ul class="space-y-3 flex-grow">
                <!-- Home Menu -->
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="group flex items-center p-3 text-base font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-200 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                        <div class="relative z-10 flex items-center w-full">
                            <div class="w-8 h-8 flex items-center justify-center transition-colors">
                                <ion-icon name="home" class="w-5 h-5 text-blue-600"></ion-icon>
                            </div>
                            <span x-show="open" x-transition class="ml-3 font-semibold">Beranda</span>
                        </div>
                    </a>
                </li>

                <!-- Divider -->
                <li x-show="open">
                    <div class="my-4 h-px w-full bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </li>

                <!-- Management Dropdown (Admin only) -->
                @if (auth()->user()->role == 'admin')
                    <li x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" type="button"
                            class="group flex items-center p-3 w-full text-base font-medium rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 transition-all duration-200 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                            <div class="relative z-10 flex items-center w-full">
                                <div class="w-8 h-8 flex items-center justify-centertransition-colors">
                                    <ion-icon name="document-text" class="w-5 h-5 text-purple-600"></ion-icon>
                                </div>
                                <span x-show="open" x-transition class="ml-3 font-semibold">Manajemen</span>
                                <svg x-show="open" aria-hidden="true"
                                     class="w-5 h-5 text-gray-500 ml-auto transform transition-transform duration-300"
                                     :class="openDropdown ? 'rotate-180' : ''"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <ul x-show="open && openDropdown" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-2 space-y-2 ml-2">
                            
                            <li>
                                <a href="{{ route('tambah.sertifikat') }}" 
                                   class="group flex items-center p-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 transition-all duration-200 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-green-500/5 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                                    <div class="relative z-10 flex items-center">
                                        <div class="w-6 h-6 flex items-center justify-center transition-colors mr-3">
                                            <ion-icon name="people" class="w-4 h-4 text-emerald-600"></ion-icon>
                                        </div>
                                        Data Siswa
                                    </div>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('sertifikat.import.form') }}" 
                                   class="group flex items-center p-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 hover:text-orange-700 transition-all duration-200 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-orange-500/5 to-yellow-500/5 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                                    <div class="relative z-10 flex items-center">
                                        <div class="w-6 h-6 flex items-center justify-center transition-colors mr-3">
                                            <ion-icon name="cloud-upload" class="w-4 h-4 text-orange-600"></ion-icon>
                                        </div>
                                        Import Excel
                                    </div>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('sertifikat.upload') }}" 
                                   class="group flex items-center p-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50 hover:text-cyan-700 transition-all duration-200 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 to-blue-500/5 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                                    <div class="relative z-10 flex items-center">
                                        <div class="w-6 h-6 flex items-center justify-center transition-colors mr-3">
                                            <ion-icon name="add-circle" class="w-4 h-4 text-cyan-600"></ion-icon>
                                        </div>
                                        Tambah Sertifikat
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Profile & Logout Section -->
            <div class="mt-auto border-t border-gray-200/50 pt-4">
                <!-- Profile Info (only shows when sidebar is open) -->
                <div x-show="open" x-transition class="mb-4 p-4 bg-gradient-to-r from-slate-50 to-gray-100 rounded-xl border border-gray-200/50">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                                alt="Profile"
                                class="w-10 h-10 rounded-full shadow-md border-2 border-white">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        :class="open ? 'w-full justify-start px-4 py-3' : 'w-12 h-12 justify-center mx-auto'"
                        class="group flex items-center rounded-xl text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 transition-all duration-200 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-pink-500/5 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                        <div class="relative z-10 flex items-center">
                            <div class="w-8 h-8 flex items-center justify-center transition-colors">
                                <ion-icon name="log-out-outline" class="w-5 h-5 text-red-600"></ion-icon>
                            </div>
                            <span x-show="open" x-transition class="ml-3 text-sm font-semibold">Log Out</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </aside>
</nav>

<style>
/* Custom animations for sidebar */
@keyframes pulse {
  0%, 100% {
    opacity: 0.3;
  }
  50% {
    opacity: 0.8;
  }
}

.animate-pulse {
  animation: pulse 3s ease-in-out infinite;
}

.delay-1000 {
  animation-delay: 1s;
}

/* Smooth transitions for Alpine.js */
.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Custom scrollbar for sidebar */
aside::-webkit-scrollbar {
  width: 4px;
}

aside::-webkit-scrollbar-track {
  background: transparent;
}

aside::-webkit-scrollbar-thumb {
  background: rgba(156, 163, 175, 0.3);
  border-radius: 2px;
}

aside::-webkit-scrollbar-thumb:hover {
  background: rgba(156, 163, 175, 0.5);
}
</style>