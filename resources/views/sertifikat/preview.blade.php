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
    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-6 sm:px-20 bg-gradient-to-r from-green-50 to-white border-b border-gray-200 rounded-t-2xl">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📊 Pratinjau Data Sertifikat yang Diimpor</h2>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                            <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                            <span class="block sm:inline font-semibold">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('imported_sertifikats'))
                        <form action="{{ route('sertifikat.import.confirm') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="overflow-x-auto mb-6 border border-gray-200 rounded-lg shadow-md">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-green-600">
                                        <tr>
                                            @foreach (['NIS', 'Nama Siswa', 'Jenis Sertifikat', 'Judul Sertifikat', 'Tanggal Diraih', 'Foto Sertifikat (Opsional)'] as $header)
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach (session('imported_sertifikats') as $index => $sertifikat)
                                            <tr class="hover:bg-green-50 transition">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][nis]" value="{{ old('sertifikats.' . $index . '.nis', $sertifikat['nis']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][nama_siswa]" value="{{ old('sertifikats.' . $index . '.nama_siswa', $sertifikat['nama_siswa']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][jenis_sertifikat]" value="{{ old('sertifikats.' . $index . '.jenis_sertifikat', $sertifikat['jenis_sertifikat']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][judul_sertifikat]" value="{{ old('sertifikats.' . $index . '.judul_sertifikat', $sertifikat['judul_sertifikat']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <x-text-input type="date" name="sertifikats[{{ $index }}][tanggal_diraih]" value="{{ old('sertifikats.' . $index . '.tanggal_diraih', $sertifikat['tanggal_diraih']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="file" name="foto_sertifikat[{{ $index }}]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 transition shadow-lg">
                                    ✅ Konfirmasi Impor
                                </button>
                                <a href="{{ route('sertifikat.import.form') }}" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 transition ml-4 shadow-lg">
                                    ❌ Batal
                                </a>
                            </div>
                        </form>
                    @else
                        <p class="text-center text-gray-600 text-lg py-8">Tidak ada data sertifikat yang diimpor untuk pratinjau.</p>
                        <div class="flex justify-center mt-6">
                            <a href="{{ route('sertifikat.import.form') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition shadow-lg">
                                ⬅ Kembali ke Halaman Impor
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
