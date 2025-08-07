<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Back to Home Button -->
                <div class="absolute top-4 left-4 z-20">
                    <a href="/" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-90 hover:bg-opacity-100 text-blue-900 rounded-lg shadow-md transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="font-medium">Kembali ke Beranda</span>
                    </a>
                </div>
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="ml-3 text-2xl font-bold text-blue-900">Certisat</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
                    <p class="text-gray-600 mt-2">Bergabunglah dengan platform manajemen sertifikat terdepan</p>
                </div>

                <form method="POST" action="{{ route('register') }}" id="register-form" class="space-y-6">
                    @csrf

                    <!-- Hidden Role Input -->
                    <input type="hidden" name="role" id="role" value="">

                    <!-- Account Type Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Jenis Akun *</label>
                        <div class="grid grid-cols-1 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="account_type" value="admin" class="sr-only peer" onclick="selectAccountType('admin')">
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg peer-checked:border-blue-900 peer-checked:bg-blue-50 hover:border-blue-300 transition-all">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 peer-checked:bg-blue-900 mr-3">
                                        <svg class="w-5 h-5 text-gray-600 peer-checked:text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">Admin Sekolah</div>
                                        <div class="text-sm text-gray-500">Kelola sertifikat siswa sekolah</div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" name="account_type" value="perusahaan" class="sr-only peer" onclick="selectAccountType('perusahaan')">
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg peer-checked:border-blue-900 peer-checked:bg-blue-50 hover:border-blue-300 transition-all">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 peer-checked:bg-blue-900 mr-3">
                                        <svg class="w-5 h-5 text-gray-600 peer-checked:text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">Perusahaan Mitra</div>
                                        <div class="text-sm text-gray-500">Berikan sertifikat kepada siswa</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Personal</h3>
                        
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Nama Lengkap *" class="text-gray-700" />
                            <x-text-input id="name" 
                                class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                type="text" 
                                name="name"
                                placeholder="Masukkan nama lengkap"
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email and Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="email" value="Email *" class="text-gray-700" />
                                <x-text-input id="email" 
                                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    type="email" 
                                    name="email"
                                    placeholder="nama@email.com"
                                    :value="old('email')" 
                                    required 
                                    autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="phone" value="Nomor Telepon *" class="text-gray-700" />
                                <x-text-input id="phone" 
                                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    type="tel" 
                                    name="phone"
                                    placeholder="08xxxxxxxxxx"
                                    :value="old('phone')" 
                                    required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Organization Information Section -->
                    <div class="space-y-4" id="organization-section">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Organisasi</h3>
                        
                        <div>
                            <x-input-label for="organization_name" value="Nama Perusahaan/Sekolah *" class="text-gray-700" />
                            <x-text-input id="organization_name" 
                                class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                type="text" 
                                name="organization_name"
                                placeholder="Contoh: PT. Technology Indonesia"
                                :value="old('organization_name')" 
                                required />
                            <x-input-error :messages="$errors->get('organization_name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Keamanan Akun</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="password" value="Password *" class="text-gray-700" />
                                <div class="relative">
                                    <x-text-input id="password" 
                                        class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10" 
                                        type="password" 
                                        name="password"
                                        placeholder="Minimal 8 karakter"
                                        required 
                                        autocomplete="new-password" />
                                    <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password *" class="text-gray-700" />
                                <div class="relative">
                                    <x-text-input id="password_confirmation" 
                                        class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10" 
                                        type="password" 
                                        name="password_confirmation"
                                        placeholder="Ulangi password"
                                        required 
                                        autocomplete="new-password" />
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms" required class="mt-1 h-4 w-4 text-blue-900 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            Saya menyetujui <a href="#" class="text-blue-900 hover:text-blue-500">Syarat dan Ketentuan</a> serta <a href="#" class="text-blue-900 hover:text-blue-500">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit-btn" disabled class="w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-medium transition-colors duration-200 cursor-not-allowed">
                        Daftar Sekarang
                    </button>

                    <!-- Login Link -->
                    <div class="text-center">
                        <span class="text-gray-600">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="text-blue-900 hover:text-blue-500 font-medium">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let selectedRole = '';

        function selectAccountType(role) {
            selectedRole = role;
            updateSubmitButton();
        }

        function updateSubmitButton() {
            const termsChecked = document.getElementById('terms').checked;
            const submitBtn = document.getElementById('submit-btn');
            
            if (selectedRole && termsChecked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-blue-900', 'hover:bg-blue-700');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-blue-900', 'hover:bg-blue-700');
            }
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }

        // Event listeners
        document.getElementById('terms').addEventListener('change', updateSubmitButton);

        document.getElementById('register-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!selectedRole) {
                alert('Silakan pilih jenis akun terlebih dahulu');
                return;
            }
            
            if (!document.getElementById('terms').checked) {
                alert('Silakan setujui syarat dan ketentuan terlebih dahulu');
                return;
            }
            
            document.getElementById('role').value = selectedRole;
            this.submit();
        });

        // Initialize
        updateSubmitButton();
    </script>

    <style>
        .peer:checked ~ div {
            border-color: #7c3aed;
            background-color: #f3f4f6;
        }
        
        .peer:checked ~ div .bg-gray-100 {
            background-color: #7c3aed;
        }
        
        .peer:checked ~ div .text-gray-600 {
            color: white;
        }
    </style>
</x-guest-layout>