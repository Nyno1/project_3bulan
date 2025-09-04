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
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 mb-6 group transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            <!-- siswa card -->
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

            <!-- Sertifikat -->
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
                        <!-- Hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center space-x-2">
                            <!-- Lihat -->
                            <a href="{{ Storage::url($sertifikat->foto_sertifikat) }}" target="_blank"
                                class="p-2 bg-white rounded-full hover:bg-blue-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('sertifikat.edit', $sertifikat->id) }}"
                                class="p-2 bg-white rounded-full hover:bg-green-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <!-- Hapus  -->
                            <button onclick="confirmDelete('{{ $sertifikat->id }}', '{{ $sertifikat->judul_sertifikat }}')"
                                class="p-2 bg-white rounded-full hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <!-- Form tersembunyi untuk delete -->
                            <form id="delete-form-{{ $sertifikat->id }}" action="{{ route('sertifikat.destroy', $sertifikat->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(sertifikatId, judulSertifikat) {
            Swal.fire({
                title: 'Hapus Sertifikat?',
                text: `Apakah Anda yakin ingin menghapus sertifikat "${judulSertifikat}"? `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2',
                    cancelButton: 'rounded-xl px-6 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${sertifikatId}`).submit();
                    
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus sertifikat',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        customClass: {
                            popup: 'rounded-2xl'
                        }
                    });
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-2'
                }
            });
        @endif
    </script>
</x-app-layout>