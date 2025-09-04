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
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8">
            <div class="max-w-4xl mx-auto px-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-certificate text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Edit Sertifikat</h1>
                        <p class="text-blue-100 mt-1">Perbarui informasi sertifikat Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto py-8 px-6">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informasi Sertifikat</h2>
                            <p class="text-gray-600 text-sm mt-1">Lengkapi form berikut untuk memperbarui data sertifikat</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span>Field bertanda <span class="text-red-500">*</span> wajib diisi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data" class="px-8 py-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            {{-- Jenis Sertifikat Dropdown --}}
                            <div class="group">
                                <label for="jenis_sertifikat" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-tag text-blue-500 mr-2"></i>
                                    Jenis Sertifikat 
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <select id="jenis_sertifikat" name="jenis_sertifikat" 
                                            class="w-full border-2 border-gray-300 rounded-xl p-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 appearance-none bg-white @error('jenis_sertifikat') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror">
                                        <option value="">Pilih Jenis Sertifikat</option>
                                        <option value="BNSP" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'BNSP' ? 'selected' : '' }}>
                                            BNSP (Badan Nasional Sertifikasi Profesi)
                                        </option>
                                        <option value="Kompetensi" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'Kompetensi' ? 'selected' : '' }}>
                                            Sertifikat Kompetensi
                                        </option>
                                        <option value="Internasional" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'Internasional' ? 'selected' : '' }}>
                                            Sertifikat Internasional
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('jenis_sertifikat')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Judul Sertifikat Input --}}
                            <div class="group">
                                <label for="judul_sertifikat" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-award text-yellow-500 mr-2"></i>
                                    Judul Sertifikat 
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" 
                                           id="judul_sertifikat" 
                                           name="judul_sertifikat" 
                                           value="{{ old('judul_sertifikat', $sertifikat->judul_sertifikat) }}" 
                                           placeholder="Masukkan judul sertifikat"
                                           class="w-full border-2 border-gray-300 rounded-xl p-4 pl-12 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 @error('judul_sertifikat') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-4">
                                        <i class="fas fa-file-alt text-gray-400"></i>
                                    </div>
                                </div>
                                @error('judul_sertifikat')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Tanggal Diraih Input --}}
                            <div class="group">
                                <label for="tanggal_diraih" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-calendar-alt text-green-500 mr-2"></i>
                                    Tanggal Diraih 
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input type="date" 
                                           id="tanggal_diraih" 
                                           name="tanggal_diraih" 
                                           value="{{ old('tanggal_diraih', $sertifikat->tanggal_diraih ? \Carbon\Carbon::parse($sertifikat->tanggal_diraih)->format('Y-m-d') : '') }}" 
                                           class="w-full border-2 border-gray-300 rounded-xl p-4 pl-12 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 @error('tanggal_diraih') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-4">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                    </div>
                                </div>
                                @error('tanggal_diraih')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Foto Sertifikat Input --}}
                            <div class="group">
                                <label for="foto_sertifikat" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-image text-purple-500 mr-2"></i>
                                    Foto Sertifikat 
                                    <span class="text-gray-500 ml-2 text-xs font-normal">(Opsional)</span>
                                </label>
                                
                                {{-- Display Foto --}}
                                @if($sertifikat->foto_sertifikat && Storage::exists('public/' . $sertifikat->foto_sertifikat))
                                    <div class="mb-6 p-4 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                        <div class="text-center">
                                            <p class="text-sm font-medium text-gray-600 mb-3 flex items-center justify-center">
                                                <i class="fas fa-image mr-2"></i>Foto Saat Ini
                                            </p>
                                            <div class="inline-block p-2 bg-white rounded-lg shadow-sm">
                                                <img src="{{ Storage::url($sertifikat->foto_sertifikat) }}" 
                                                     alt="Current certificate photo" 
                                                     class="h-40 w-auto object-cover rounded-lg border border-gray-200 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="relative">
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-200 @error('foto_sertifikat') border-red-400 @enderror">
                                        <input type="file" 
                                               id="foto_sertifikat" 
                                               name="foto_sertifikat" 
                                               accept="image/*"
                                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                        
                                        <div class="space-y-3">
                                            <div class="mx-auto w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-cloud-upload-alt text-blue-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 font-medium">Klik untuk unggah foto baru</p>
                                                <p class="text-gray-500 text-sm mt-1">atau drag & drop file ke sini</p>
                                            </div>
                                            <div class="flex items-center justify-center space-x-4 text-xs text-gray-500">
                                                <span class="flex items-center">
                                                    <i class="fas fa-file-image mr-1"></i>JPG, PNG, GIF
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-weight-hanging mr-1"></i>Max 2MB
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @error('foto_sertifikat')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror

                                <!-- Preview -->
                                <div id="image-preview" class="hidden mt-4 p-4 bg-green-50 rounded-xl border border-green-200">
                                    <p class="text-sm font-medium text-green-700 mb-3 flex items-center">
                                        <i class="fas fa-eye mr-2"></i>Preview Foto Baru
                                    </p>
                                    <div class="text-center">
                                        <img id="preview-img" class="inline-block h-40 w-auto object-cover rounded-lg border border-green-300 shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Button Submit --}}
                    <div class="mt-10 pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4 sm:justify-end">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-100 transition-all duration-200 text-center">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                        
                        <!-- Mobile Info -->
                        <div class="sm:hidden mt-4 p-3 bg-blue-50 rounded-lg">
                            <p class="text-xs text-blue-700 text-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Field bertanda <span class="text-red-500 font-semibold">*</span> wajib diisi
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Enhanced Preview Image Script --}}
    <script>
        document.getElementById('foto_sertifikat').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            
            if (file) {
                // Validate file size
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                // Validate file type
                if (!file.type.match(/^image\/(jpeg|jpg|png|gif)$/)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    this.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    
                    // Smooth scroll to preview
                    preview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        // Drag and drop functionality
        const dropZone = document.getElementById('foto_sertifikat').parentElement;
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        }
        
        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                document.getElementById('foto_sertifikat').files = files;
                document.getElementById('foto_sertifikat').dispatchEvent(new Event('change'));
            }
        }
    </script>
</x-app-layout>