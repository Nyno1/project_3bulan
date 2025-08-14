<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-900 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-blue-900 mb-3">Tambah Sertifikat Baru</h2>
                <div class="w-24 h-1 bg-blue-900 mx-auto mb-6"></div>
            </div>

            <!-- Welcome Message -->
            <div class="bg-white rounded-xl shadow-lg border border-blue-100 p-6 mb-8">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">👋</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-700 leading-relaxed">
                            Hai <span class="font-semibold text-blue-900">{{ Auth::user()->name }}</span>, pastikan kamu mengisi data sertifikat ini dengan benar, ya!
                            Sertifikat yang kamu tambahkan akan muncul di halaman pencarian siswa dan bisa langsung dilihat oleh mereka.
                            Yuk, bantu siswa merayakan pencapaian mereka dengan data yang akurat dan lengkap 🎉.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Form Section -->
            <div class="bg-white rounded-xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Data Sertifikat
                    </h3>
                </div>

                <form action="/sertifikat/store" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf

                    <!-- NIS -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            NIS
                        </label>
                        <input type="text" name="nis" required placeholder="Masukkan NIS Siswa"
                            class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 cursor-pointer bg-white text-gray-700 font-medium hover:border-blue-300">
                    </div>

                    <!-- Nama Siswa -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Nama Siswa
                        </label>
                        <input type="text" name="nama_siswa" required placeholder="Masukkan Nama Siswa"
                            class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 cursor-pointer bg-white text-gray-700 font-medium hover:border-blue-300">
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Jenis Sertifikat Modern -->
                        <div class="w-full md:w-1/2">
                            <label for="jenis_sertifikat" class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 
                                        3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 
                                        00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 
                                        3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 
                                        3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 
                                        3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 
                                        00-.806-1.946 3.42 3.42 0 010-4.438 
                                        3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                                Jenis Sertifikat
                            </label>
                            <div class="relative">
                                <select name="jenis_sertifikat" id="jenis_sertifikat" class="peer w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 cursor-pointer bg-white text-gray-700 font-medium hover:border-blue-300 appearance-none" required>
                                    <option value="" disabled selected class="text-gray-400">Pilih Jenis Sertifikat</option>
                                    <option value="Sertifikat Kompetensi">Sertifikat Kompetensi</option>
                                    <option value="Sertifikat BNSP">Sertifikat BNSP</option>
                                    <option value="Sertifikat Internasional">Sertifikat Internasional</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-900 transition-transform duration-200 peer-focus:rotate-180" 
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Judul Sertifikat -->
                        <div class="w-full md:w-1/2">
                            <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                Judul Sertifikat
                            </label>
                            <input type="text" name="judul_sertifikat" required placeholder="Masukkan Judul Sertifikat"
                                class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 cursor-pointer bg-white text-gray-700 font-medium hover:border-blue-300">
                        </div>
                    </div>

                    <!-- Tanggal Diraih -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Tanggal Diraih
                        </label>
                        <input type="date" name="tanggal_diraih" required
                            class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 cursor-pointer bg-white text-gray-700 font-medium hover:border-blue-300">
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 border-t border-blue-100">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-900 to-blue-800 hover:from-blue-800 hover:to-blue-700 text-white px-8 py-4 rounded-lg shadow-lg font-semibold text-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Simpan Sertifikat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
