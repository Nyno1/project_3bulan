<x-app-layout>
  <div x-data="{ 
        open: JSON.parse(localStorage.getItem('sidebarOpen') || 'true'),
        files: [],
        previewUrls: []
      }"
      x-init="
        window.addEventListener('sidebar-toggled', () => {
          open = JSON.parse(localStorage.getItem('sidebarOpen'));
        });
      "
      :class="open ? 'ml-64' : 'ml-16'"
      class="transition-all duration-300">

    <div class="relative py-12 min-h-screen bg-gradient-to-br from-indigo-100 via-white to-blue-100 overflow-hidden flex items-center justify-center">
      <div class="absolute inset-0 opacity-20 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png')]"></div>
      <div class="absolute -top-20 -left-20 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
      <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
      <div class="absolute inset-0">
        <img src="/images/pattern.png" alt="Background Pattern" class="w-full h-full object-cover opacity-20 pointer-events-none">
      </div>
      <div class="max-w-4xl w-full bg-white shadow-lg hover:shadow-2xl rounded-2xl p-8 border border-blue-200 relative z-10 transition duration-300">
        <div class="text-center mb-8">
          <h2 class="text-2xl font-bold text-gray-800">Upload Sertifikat Siswa</h2>
          <p class="text-gray-600 mt-2">Upload foto sertifikat dengan nama file sesuai NIS siswa</p>
        </div>

        <form action="{{ route('sertifikat.upload.massal') }}" method="POST" 
              enctype="multipart/form-data" class="space-y-6">
          @csrf
          
          <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Upload Foto Sertifikat
            </label>
            <!-- File Upload Area -->
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition-colors duration-200"
                 x-on:dragover.prevent="$el.classList.add('border-blue-400')"
                 x-on:dragleave.prevent="$el.classList.remove('border-blue-400')"
                 x-on:drop.prevent="
                   $el.classList.remove('border-blue-400');
                   files = [...$event.dataTransfer.files];
                   [...$event.dataTransfer.files].forEach(file => {
                     const reader = new FileReader();
                     reader.onload = (e) => {
                       previewUrls.push(e.target.result);
                     };
                     reader.readAsDataURL(file);
                   });
                 ">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                    <span>Upload files</span>
                    <input type="file" name="foto_sertifikat[]" class="sr-only" multiple accept="image/*"
                           x-on:change="
                             files = [...$event.target.files];
                             [...$event.target.files].forEach(file => {
                               const reader = new FileReader();
                               reader.onload = (e) => {
                                 previewUrls.push(e.target.result);
                               };
                               reader.readAsDataURL(file);
                             });
                           ">
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">
                  Format file: JPG, PNG (Max. 5MB)<br>
                  Nama file harus sesuai NIS siswa (contoh: 1234567.jpg)
                </p>
              </div>
            </div>

            <div class="mt-4 grid grid-cols-4 gap-4" x-show="previewUrls.length">
              <template x-for="(url, index) in previewUrls" :key="index">
                <div class="relative">
                  <img :src="url" class="h-24 w-24 object-cover rounded-lg">
                  <button type="button" 
                          class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1"
                          @click="previewUrls.splice(index, 1); files.splice(index, 1)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
              </template>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Sertifikat</label>
                <select name="jenis_sertifikat" required 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled selected>Pilih jenis sertifikat</option>
                    <option value="BNSP">BNSP</option>
                    <option value="Kompetensi">Kompetensi</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Diraih</label>
                <input type="date" name="tanggal_diraih" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Judul Sertifikat</label>
            <input type="text" name="judul_sertifikat" required placeholder="Masukkan judul sertifikat" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
          <div class="flex justify-end mt-6">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
              Upload Sertifikat
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>