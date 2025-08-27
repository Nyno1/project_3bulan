<x-app-layout>
    <div 
    x-data="{
        open: JSON.parse(localStorage.getItem('sidebarOpen') || 'true'),
    }"
    x-init="
        window.addEventListener('sidebar-toggled', () => {
            open = JSON.parse(localStorage.getItem('sidebarOpen'));
        });
    "
    :class="open ? 'ml-64' : 'ml-16'"
    class="transition-all duration-300"
>
    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-blue-100 py-12 px-4 relative overflow-hidden">
        <div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>
        
        <!-- Decorative Floating Elements -->
        <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 float-animation"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 bg-blue-300 rounded-full opacity-30 float-animation" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-5 w-16 h-16 bg-blue-400 rounded-full opacity-25 float-animation" style="animation-delay: -4s;"></div>
        <div class="absolute top-1/4 right-10 w-20 h-20 bg-blue-500 rounded-full opacity-15 float-animation" style="animation-delay: -1s;"></div>
        
        <div class="max-w-2xl mx-auto relative z-10">
            <div class="text-center mb-8 slide-in-left">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 rounded-full mb-6 glow-effect shadow-2xl shimmer-effect">
                    <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-5xl font-bold text-white mb-4 drop-shadow-2xl">
                    <span class="bg-gradient-to-r from-blue-300 to-blue-400 bg-clip-text text-transparent">
                        Tambah Siswa Baru
                    </span>
                </h2>
                <div class="w-32 h-1 bg-gradient-to-r from-transparent via-blue-300 to-transparent mx-auto mb-6 pulse-gentle"></div>
                <p class="text-gray-400 text-lg font-medium drop-shadow-lg">Kelola data siswa dengan mudah dan efisien</p>
            </div>

            <div class="glass-morphism rounded-2xl shadow-2xl border border-white/30 p-8 mb-8 slide-in-up hover-lift group">
                <div class="flex items-start space-x-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-blue-900 mb-3">Selamat Datang <span class="font-bold text-blue-900 bg-blue-50 px-3 py-1 rounded-lg shadow-sm">{{ Auth::user()->name }}!</span></h3>
                        <p class="text-gray-700 leading-relaxed text-base">
                            Hai, pastikan kamu mengisi data sertifikat ini dengan benar, ya!
                            Sertifikat yang kamu tambahkan akan muncul di halaman pencarian siswa dan bisa langsung dilihat oleh mereka.
                            <br><br>
                            <span class="inline-flex items-center font-semibold text-blue-800 bg-blue-50 px-3 py-2 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Yuk, bantu siswa merayakan pencapaian mereka dengan data yang akurat dan lengkap 
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 border-2 border-green-200 rounded-2xl p-6 mb-8 shadow-xl slide-in-up hover-lift">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg shimmer-effect">
                                <svg class="w-7 h-7 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-800 font-bold text-lg">Berhasil!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Section -->
            <div class="glass-morphism rounded-2xl shadow-2xl border border-white/30 overflow-hidden slide-in-up hover-lift" style="animation-delay: 0.2s;">
                <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 px-8 py-6 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>
                    <h3 class="text-2xl font-bold text-white flex items-center relative z-10">
                        <svg class="w-7 h-7 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Data Siswa
                        <span class="ml-auto text-sm font-normal opacity-80 bg-white/20 px-3 py-1 rounded-full">Form Input</span>
                    </h3>
                </div>

                <!-- Form Content -->
                <form action="/sertifikat/store" method="POST" enctype="multipart/form-data" class="p-10 space-y-8 bg-gradient-to-br from-white/95 to-blue-50/80" 
                      x-data="{ submitting: false }" 
                      @submit="submitting = true">
                    @csrf

                    <!-- NIS input -->
                    <div class="relative group">
                        <label class="text-base font-bold text-blue-900 mb-3 flex items-center group-hover:text-blue-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-3 group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300 shadow-md">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            NIS (Nomor Induk Siswa)
                            <span class="text-red-500 ml-2 text-lg">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nis" required placeholder="Masukkan NIS Siswa (contoh: 2024001)"
                                class="w-full border-3 border-blue-200 rounded-2xl px-6 py-4 pl-14 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 input-focus bg-white text-gray-800 font-semibold hover:border-blue-300 shadow-lg placeholder-gray-400 transition-all duration-300">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 ml-1">
                            <svg class="w-4 h-4 inline mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pastikan nis sesuai dengan yang tertera di data
                        </p>
                    </div>

                    <!-- Nama Siswa input -->
                    <div class="relative group">
                        <label class="text-base font-bold text-blue-900 mb-3 flex items-center group-hover:text-blue-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-3 group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300 shadow-md">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            Nama Lengkap Siswa
                            <span class="text-red-500 ml-2 text-lg">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nama" required placeholder="Masukkan nama lengkap siswa"
                                class="w-full border-3 border-blue-200 rounded-2xl px-6 py-4 pl-14 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 input-focus bg-white text-gray-800 font-semibold hover:border-blue-300 shadow-lg placeholder-gray-400 transition-all duration-300">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 ml-1">
                            <svg class="w-4 h-4 inline mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pastikan nama sesuai dengan yang tertera di data
                        </p>
                    </div>

                    <!-- Submit -->
                    <div class="pt-8 border-t-2 border-gradient-to-r from-blue-100 via-blue-200 to-blue-100">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 hover:from-blue-800 hover:via-blue-700 hover:to-blue-600 text-white px-10 py-5 rounded-2xl shadow-2xl font-bold text-xl button-3d flex items-center justify-center group relative overflow-hidden disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="submitting">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform translate-x-full group-hover:translate-x-0 transition-transform duration-700"></div>
                            
                            <div x-show="submitting" class="flex items-center relative z-10">
                                <svg class="w-7 h-7 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Menyimpan Data...</span>
                            </div>
                            
                            <div x-show="!submitting" class="flex items-center relative z-10">
                                <svg class="w-7 h-7 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <span>Simpan Data Siswa</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function createParticles() {
            const particlesContainer = document.getElementById('particles1');
            if (!particlesContainer) return;
            
            setInterval(() => {
                const particle = document.createElement('div');
                particle.className = 'particlee';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.width = particle.style.height = Math.random() * 8 + 4 + 'px';
                particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                particlesContainer.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.remove();
                    }
                }, 6000);
            }, 800);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"]');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.group').classList.add('transform', 'scale-[1.02]');
                    this.parentElement.classList.add('ring-2', 'ring-blue-300');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.group').classList.remove('transform', 'scale-[1.02]');
                    this.parentElement.classList.remove('ring-2', 'ring-blue-300');
                });
                
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('border-green-300');
                        this.classList.remove('border-blue-200');
                    } else {
                        this.classList.remove('border-green-300');
                        this.classList.add('border-blue-200');
                    }
                });
            });
            
            createParticles();
            
            document.documentElement.style.scrollBehavior = 'smooth';
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            
            const ripple = document.createElement('div');
            ripple.className = 'absolute inset-0 bg-white opacity-30 rounded-2xl animate-ping';
            submitButton.style.position = 'relative';
            submitButton.appendChild(ripple);
            
            setTimeout(() => {
                if (ripple.parentNode) {
                    ripple.remove();
                }
            }, 1000);
        });
    </script>
</x-app-layout>