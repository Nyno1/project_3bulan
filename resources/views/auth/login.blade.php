<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Back to Home Button -->
            <div class="absolute top-4 left-4 z-20">
                <a href="/" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-90 hover:bg-opacity-100 text-blue-900 rounded-lg shadow-md transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="font-medium">Kembali ke Beranda</span>
                </a>
            </div>
            
            <div class="flex flex-col lg:flex-row">
                <!-- Left Panel - Welcome Section -->
                <div class="lg:w-1/2 bg-gradient-to-br from-blue-800 to-blue-900 p-8 lg:p-12 text-white relative">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 right-0 w-24 h-24 bg-white bg-opacity-10 rounded-full translate-x-12 translate-y-12"></div>
                    
                    <div class="relative z-10 flex flex-col justify-center h-full">
                        <!-- Icon -->
                        <div class="mb-8">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Welcome Text -->
                        <h1 class="text-3xl lg:text-4xl font-bold mb-4">
                            Selamat Datang Kembali!
                        </h1>
                        <p class="text-lg text-blue-100 mb-8">
                            Masuk ke akun Anda untuk mengelola sertifikat digital dengan mudah dan efisien.
                        </p>

                        <!-- Features -->
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-blue-100">Keamanan Terjamin</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zM12 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1V4zM12 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-blue-100">Platform Terintegrasi</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-blue-100">Proses Cepat & Mudah</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Login Form -->
                <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                    <!-- Header -->
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Masuk Akun</h2>
                        <p class="text-gray-600">Silakan masuk dengan kredensial Anda</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                            <x-text-input id="email" 
                                class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900 py-3 px-4" 
                                type="email" 
                                name="email" 
                                placeholder="Masukkan email Anda"
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                            <div class="relative mt-1">
                                <x-text-input id="password" 
                                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900 py-3 px-4 pr-12"
                                    type="password"
                                    name="password"
                                    placeholder="Masukkan password Anda"
                                    required 
                                    autocomplete="current-password" />
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 hover:text-blue-900 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me and Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" 
                                    class="h-4 w-4 text-blue-900 focus:ring-blue-900 border-gray-300 rounded" 
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-900 hover:text-blue-700 font-medium transition-colors" 
                                   href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <x-primary-button class="w-full bg-blue-900 hover:bg-blue-800 py-3 px-4 rounded-lg font-medium transition-colors duration-200 justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk Sekarang
                        </x-primary-button>

                        <!-- Register Link -->
                        <div class="text-center">
                            <span class="text-gray-600">Belum punya akun? </span>
                            <a href="{{ route('register') }}" class="text-blue-900 hover:text-blue-700 font-medium transition-colors">
                                Daftar di sini
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling;
            const icon = button.querySelector('svg');
            
            if (field.getAttribute('type') === 'password') {
                field.setAttribute('type', 'text');
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m-3.122-3.122l6.243 6.243"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                `;
            } else {
                field.setAttribute('type', 'password');
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        // Handle radio button styling
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('input[name="user_type"]');
            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Reset all radio buttons
                    radioInputs.forEach(radio => {
                        const container = radio.nextElementSibling;
                        const dot = container.querySelector('.w-2');
                        container.classList.remove('border-blue-900', 'bg-blue-50');
                        container.classList.add('border-gray-200');
                        if (dot) {
                            dot.classList.add('hidden');
                        }
                    });
                    
                    // Show selected radio button
                    if (this.checked) {
                        const container = this.nextElementSibling;
                        const dot = container.querySelector('.w-2');
                        container.classList.remove('border-gray-200');
                        container.classList.add('border-blue-900', 'bg-blue-50');
                        if (dot) {
                            dot.classList.remove('hidden');
                        }
                    }
                });
            });

            // Set initial state - Perusahaan Mitra selected
            const perusahaanRadio = document.querySelector('input[value="perusahaan"]');
            if (perusahaanRadio) {
                perusahaanRadio.checked = true;
                perusahaanRadio.dispatchEvent(new Event('change'));
            }
        });
    </script>

    <style>
        .peer:checked ~ div {
            border-color: #1e3a8a !important;
            background-color: #dbeafe !important;
        }
    </style>
</x-guest-layout>