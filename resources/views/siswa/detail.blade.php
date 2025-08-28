<x-app-layout>
    <div x-data="{ 
            open: JSON.parse(localStorage.getItem('sidebarOpen') || 'true'),
        }"
        x-init="
            window.addEventListener('sidebar-toggled', () => {
                open = JSON.parse(localStorage.getItem('sidebarOpen'));
            });
        "
        :class="open ? 'ml-64' : 'ml-16'"
        class="transition-all duration-300">

        <main class="py-28 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 mb-6 group transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            <!-- Student Info Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-20 w-20 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 text-2xl font-bold">
                                {{ strtoupper(substr($siswa->nama, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $siswa->nama }}</h1>
                            <p class="text-gray-500">NIS: {{ $siswa->nis }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Sertifikat</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $siswa->sertifikats->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Certificates Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Sertifikat</h2>
                    <a href="{{ route('sertifikat.upload') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Sertifikat
                    </a>
                </div>

                @if($siswa->sertifikats->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($siswa->sertifikats as $sertifikat)
                    <div class="group relative bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-blue-400 transition-all duration-200 hover:shadow-md">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ Storage::url($sertifikat->foto_sertifikat) }}"
                                alt="Sertifikat"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ 
                                        $sertifikat->jenis_sertifikat === 'Kompetensi' ? 'bg-green-100 text-green-800' : 
                                        ($sertifikat->jenis_sertifikat === 'Prestasi' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') 
                                    }} mb-2">
                                {{ $sertifikat->jenis_sertifikat }}
                            </span>
                            <h3 class="font-medium text-gray-900 mb-1">{{ $sertifikat->judul_sertifikat }}</h3>
                            <p class="text-sm text-gray-500">
                                Diraih pada: {{ \Carbon\Carbon::parse($sertifikat->tanggal_diraih)->format('d M Y') }}
                            </p>
                        </div>
                        <!-- Hover Actions -->
                        <!-- Hover Actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 
            transition-opacity duration-200 flex items-center justify-center space-x-2">

                            <!-- Lihat -->
                            <a href="{{ Storage::url($sertifikat->foto_sertifikat) }}" target="_blank"
                                class="p-2 bg-white rounded-full hover:bg-blue-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 
                     9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 
                     0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('sertifikat.edit', $sertifikat->id) }}"
                                class="p-2 bg-white rounded-full hover:bg-green-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4h2M12 2v2m6.364 1.636l-1.414 1.414M18 12h2m-2 0a6 6 0 
                     11-12 0 6 6 0 0112 0z" />
                                </svg>
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('sertifikat.destroy', $sertifikat->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white rounded-full hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada sertifikat</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai tambahkan sertifikat untuk siswa ini.</p>
                </div>
                @endif
            </div>
        </main>
    </div>
</x-app-layout>