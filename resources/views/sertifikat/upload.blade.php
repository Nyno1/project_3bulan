<x-app-layout>
  <div 
    x-data="{ 
      open: JSON.parse(localStorage.getItem('sidebarOpen') || 'true'),
      modalOpen: false,
      jenis: ''
    }"
    x-init="
      window.addEventListener('sidebar-toggled', () => {
          open = JSON.parse(localStorage.getItem('sidebarOpen'));
      });
    "
    :class="open ? 'ml-64' : 'ml-16'"
    class="transition-all duration-300"
  >
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-50 relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
      
      <!-- Background Pattern -->
      <div class="absolute inset-0">
        <img src="/images/pattern.png" alt="Background Pattern" class="w-full h-full object-cover opacity-20 pointer-events-none">
      </div>

      <!-- Upload Card -->
      <div class="max-w-lg w-full space-y-8 bg-white shadow-lg hover:shadow-2xl rounded-2xl p-8 border border-blue-200 relative z-10 transition duration-300 transform hover:-translate-y-1">
        <div>
          <h2 class="mt-2 text-center text-2xl font-bold text-gray-800">
            Tambah Sertifikat
          </h2>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('sertifikat.upload.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="space-y-6">
            
            <!-- Row Jenis & Judul -->
            <div class="flex flex-col md:flex-row gap-6">
              
              <!-- Jenis Sertifikat pakai Modal -->
              <div class="w-full md:w-1/2">
                <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                  <svg class="w-4 h-4 mr-1 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                  Jenis Sertifikat
                </label>
                <div>
                  <div @click="modalOpen = true" 
                       class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 bg-white text-gray-700 font-medium hover:border-blue-300 cursor-pointer flex justify-between items-center">
                      <span x-text="jenis || 'Pilih Jenis Sertifikat'" class="truncate text-gray-600"></span>
                      <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                      </svg>
                  </div>
                  <input type="hidden" name="jenis_sertifikat" x-model="jenis" required>
                </div>
              </div>

              <!-- Judul Sertifikat -->
              <div class="w-full md:w-1/2">
                <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                  Judul Sertifikat
                </label>
                <input type="text" name="judul_sertifikat" required placeholder="Masukkan Judul Sertifikat"
                  class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-white text-gray-700 font-medium hover:border-blue-300">
              </div>
            </div>

            <!-- Tanggal Diraih -->
            <div class="relative">
              <label class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Tanggal Diraih
              </label>
              <input type="date" name="tanggal_diraih" required
                class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-white text-gray-700 font-medium hover:border-blue-300">
            </div>

            <!-- Foto Sertifikat -->
            <div>
              <label for="foto_sertifikat" class="block text-sm font-semibold text-blue-900 mb-2">
                  Foto Sertifikat
              </label>
              <input id="foto_sertifikat" name="foto_sertifikat" type="file" accept="image/*" required
                  class="mt-1 block w-full text-sm text-gray-700 border-2 border-blue-200 rounded-xl cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-600 bg-white hover:border-blue-300 px-4 py-3">
            </div>
          </div>

          <!-- Tombol Upload -->
          <div class="pt-6 border-t border-blue-100">
            <button type="submit"
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
              Upload
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Jenis Sertifikat -->
    <div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur bg-black/30">
      <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Jenis Sertifikat</h3>
        <ul class="space-y-3">
          <template x-for="item in ['Sertifikat Kompetensi','Sertifikat BNSP','Sertifikat Internasional']">
            <li>
              <button type="button" 
                      class="w-full text-left px-4 py-2 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-400 transition"
                      @click="jenis = item; modalOpen = false">
                <span x-text="item"></span>
              </button>
            </li>
          </template>
        </ul>
        <div class="mt-4 flex justify-end">
          <button type="button" @click="modalOpen=false"
                  class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium">
            Batal
          </button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
