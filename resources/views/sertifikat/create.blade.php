<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-12">
        <h2 class="text-3xl text-center font-bold text-blue-800 mb-2"> Tambah Sertifikat Baru</h2>
        <p class="text-gray-600 mb-6">
            Hai <span>{{ Auth::user()->name }}</span> 👋, pastikan kamu mengisi data sertifikat ini dengan benar, ya!  
            Sertifikat yang kamu tambahkan akan muncul di halaman pencarian siswa dan bisa langsung dilihat oleh mereka.  
            Yuk, bantu siswa merayakan pencapaian mereka dengan data yang akurat dan lengkap 🎉.
        </p>

        @if(session('success'))
            <p class="mb-4 text-green-600 font-semibold">{{ session('success') }}</p>
        @endif

        <form action="/sertifikat/store" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- NIS -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                <input type="text" name="nis" required placeholder="Masukkan NIS Siswa"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Nama Siswa -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" required placeholder="Masukkan Nama Siswa"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jenis Sertifikat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Sertifikat</label>
                <input type="text" name="jenis_sertifikat" required placeholder="Masukkan Jenis Sertifikat"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tanggal Diraih -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Diraih</label>
                <input type="date" name="tanggal_diraih" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Foto Sertifikat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Sertifikat</label>
                <input type="file" name="foto_sertifikat" accept="image/*" required onchange="previewImage(event)" class="w-full border border-gray-300 rounded-md px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                <img id="preview" class="mt-4 w-48 rounded shadow hidden">
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow transition duration-150">
                    Simpan Sertifikat
                </button>
            </div>
        </form>
    </div>

    <!-- Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
