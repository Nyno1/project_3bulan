<x-app-layout>
  <body class="bg-gray-50 text-gray-800 font-sans">
    <main class="pt-28 px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto">
      <!-- Hero -->
      <section class="mb-10">
        <h2 class="text-xl font-semibold text-gray-700">Selamat Datang! {{ Auth::user()->name }}</h2>
        <p class="text-gray-500">Kelola data sertifikat siswa dan pantau statistik sistem dengan mudah.</p>
      </section>

      <!-- Statistik -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Sertifikat -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg p-6 text-white relative overflow-hidden group">
          <div class="absolute right-4 top-4 opacity-20 group-hover:scale-110 transition-transform duration-300">
            📄
          </div>
          <h2 class="text-4xl font-extrabold mb-1">{{ $totalSertifikasi }}</h2>
          <p class="opacity-90">Total Sertifikat</p>
        </div>

        <!-- Total Siswa -->
        <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl shadow-lg p-6 text-white relative overflow-hidden group">
          <div class="absolute right-4 top-4 opacity-20 group-hover:scale-110 transition-transform duration-300">
            👨‍🎓
          </div>
          <h2 class="text-4xl font-extrabold mb-1">{{ $totalSiswa }}</h2>
          <p class="opacity-90">Total Siswa</p>
        </div>

        <!-- Sertifikat Bulan Ini -->
        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-xl shadow-lg p-6 text-white relative overflow-hidden group">
          <div class="absolute right-4 top-4 opacity-20 group-hover:scale-110 transition-transform duration-300">
            📅
          </div>
          <h2 class="text-4xl font-extrabold mb-1">{{ $totalSertifikatBulanIni }}</h2>
          <p class="opacity-90">Sertifikat Bulan Ini</p>
        </div>

        <!-- Admin Aktif -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg p-6 text-white relative overflow-hidden group">
          <div class="absolute right-4 top-4 opacity-20 group-hover:scale-110 transition-transform duration-300">
            🛠
          </div>
          <h2 class="text-4xl font-extrabold mb-1">{{ $totalAdminAktif }}</h2>
          <p class="opacity-90">Admin Aktif</p>
        </div>
      </section>

      <!-- Sertifikat Terbaru -->
      <section class="mb-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
          <h2 class="text-xl font-semibold text-blue-800">Sertifikat Terbaru</h2>
          <a href="{{ url('/sertifikat/create') }}"
             class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah Sertifikat
          </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
          <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-blue-50 border-b">
              <tr>
                <th class="px-6 py-3 font-semibold text-blue-800">Nama Siswa</th>
                <th class="px-6 py-3 font-semibold text-blue-800">NIS</th>
                <th class="px-6 py-3 font-semibold text-blue-800">Jenis Sertifikat</th>
                <th class="px-6 py-3 font-semibold text-blue-800">Judul Sertifikat</th>
                <th class="px-6 py-3 font-semibold text-blue-800">Tanggal</th>
                <th class="px-6 py-3 font-semibold text-blue-800">Sertifikat</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sertifikats as $sertif)
              <tr class="border-b hover:bg-gray-50 transition">
                <td class="px-6 py-4">{{ $sertif->nama_siswa }}</td>
                <td class="px-6 py-4">{{ $sertif->nis }}</td>
                <td class="px-6 py-4">{{ $sertif->jenis_sertifikat }}</td>
                <td class="px-6 py-4">{{ $sertif->judul_sertifikat }}</td>
                <td class="px-6 py-4">{{ $sertif->tanggal_diraih }}</td>
                <td class="px-6 py-4">
                  @if ($sertif->foto_sertifikat)
                    <img src="{{ asset('storage/'.$sertif->foto_sertifikat) }}" alt="Sertifikat" class="w-16 h-16 object-cover rounded shadow">
                  @else
                    <span class="text-gray-400">Tidak ada foto</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

    </main>
    @include('profile.partials.footer')
  </body>
</x-app-layout>
