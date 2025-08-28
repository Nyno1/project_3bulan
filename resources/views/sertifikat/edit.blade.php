<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Sertifikat</h1>

            {{-- Display Success/Error Messages --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Jenis Sertifikat Dropdown --}}
                <div class="mb-6">
                    <label for="jenis_sertifikat" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Sertifikat <span class="text-red-500">*</span>
                    </label>
                    <select id="jenis_sertifikat" name="jenis_sertifikat" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenis_sertifikat') border-red-500 @enderror">
                        <option value="">Pilih Jenis Sertifikat</option>
                        <option value="BNSP" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'BNSP' ? 'selected' : '' }}>
                            BNSP
                        </option>
                        <option value="Kompetensi" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'Kompetensi' ? 'selected' : '' }}>
                            Kompetensi
                        </option>
                        <option value="Internasional" {{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) == 'Internasional' ? 'selected' : '' }}>
                            Internasional
                        </option>
                    </select>
                    @error('jenis_sertifikat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Judul Sertifikat Input --}}
                <div class="mb-6">
                    <label for="judul_sertifikat" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Sertifikat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="judul_sertifikat" 
                           name="judul_sertifikat" 
                           value="{{ old('judul_sertifikat', $sertifikat->judul_sertifikat) }}" 
                           placeholder="Masukkan judul sertifikat"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul_sertifikat') border-red-500 @enderror">
                    @error('judul_sertifikat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Diraih Input --}}
                <div class="mb-6">
                    <label for="tanggal_diraih" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Diraih <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="tanggal_diraih" 
                           name="tanggal_diraih" 
                           value="{{ old('tanggal_diraih', $sertifikat->tanggal_diraih ? \Carbon\Carbon::parse($sertifikat->tanggal_diraih)->format('Y-m-d') : '') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_diraih') border-red-500 @enderror">
                    @error('tanggal_diraih')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto Sertifikat Input --}}
                <div class="mb-6">
                    <label for="foto_sertifikat" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto Sertifikat (Opsional)
                    </label>
                    
                    {{-- Current Photo Display --}}
                    @if($sertifikat->foto_sertifikat && Storage::exists('public/' . $sertifikat->foto_sertifikat))
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                            <img src="{{ Storage::url($sertifikat->foto_sertifikat) }}" 
                                 alt="Current certificate photo" 
                                 class="h-32 w-auto object-cover rounded-lg border border-gray-300">
                        </div>
                    @endif

                    <input type="file" 
                           id="foto_sertifikat" 
                           name="foto_sertifikat" 
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('foto_sertifikat') border-red-500 @enderror">
                    
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    
                    @error('foto_sertifikat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="px-6 py-3 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Preview Image Script --}}
    <script>
        document.getElementById('foto_sertifikat').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview if doesn't exist
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'image-preview';
                        preview.className = 'mt-4';
                        preview.innerHTML = `
                            <p class="text-sm text-gray-600 mb-2">Preview foto baru:</p>
                            <img id="preview-img" class="h-32 w-auto object-cover rounded-lg border border-gray-300">
                        `;
                        document.getElementById('foto_sertifikat').parentNode.appendChild(preview);
                    }
                    document.getElementById('preview-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>