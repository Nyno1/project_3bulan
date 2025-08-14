<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Sertifikat') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pratinjau Data Sertifikat yang Diimpor</h2>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline font-semibold">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('imported_sertifikats'))
                        <form action="{{ route('sertifikat.import.confirm') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="overflow-x-auto mb-6 border border-gray-200 rounded-lg shadow-sm">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Sertifikat</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Sertifikat</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Diraih</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Sertifikat (Opsional)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach (session('imported_sertifikats') as $index => $sertifikat)
                                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="hidden" name="sertifikats[{{ $index }}][nis]" value="{{ $sertifikat['nis'] }}">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][nis]" value="{{ old('sertifikats.' . $index . '.nis', $sertifikat['nis']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="hidden" name="sertifikats[{{ $index }}][nama_siswa]" value="{{ $sertifikat['nama_siswa'] }}">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][nama_siswa]" value="{{ old('sertifikats.' . $index . '.nama_siswa', $sertifikat['nama_siswa']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="hidden" name="sertifikats[{{ $index }}][jenis_sertifikat]" value="{{ $sertifikat['jenis_sertifikat'] }}">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][jenis_sertifikat]" value="{{ old('sertifikats.' . $index . '.jenis_sertifikat', $sertifikat['jenis_sertifikat']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="hidden" name="sertifikats[{{ $index }}][judul_sertifikat]" value="{{ $sertifikat['judul_sertifikat'] }}">
                                                    <x-text-input type="text" name="sertifikats[{{ $index }}][judul_sertifikat]" value="{{ old('sertifikats.' . $index . '.judul_sertifikat', $sertifikat['judul_sertifikat']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="hidden" name="sertifikats[{{ $index }}][tanggal_diraih]" value="{{ $sertifikat['tanggal_diraih'] }}">
                                                    <x-text-input type="date" name="sertifikats[{{ $index }}][tanggal_diraih]" value="{{ old('sertifikats.' . $index . '.tanggal_diraih', $sertifikat['tanggal_diraih']) }}" class="w-full"/>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="file" name="foto_sertifikat[{{ $index }}]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Konfirmasi Impor
                                </button>
                                <a href="{{ route('sertifikat.import.form') }}" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4 shadow-md">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Batal
                                </a>
                            </div>
                        </form>
                    @else
                        <p class="text-center text-gray-600 text-lg py-8">Tidak ada data sertifikat yang diimpor untuk pratinjau.</p>
                        <div class="flex justify-center mt-6">
                            <a href="{{ route('sertifikat.import.form') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                                Kembali ke Halaman Impor
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
