<x-app-layout>
  <body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 font-sans">
    <main class="pt-28 px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto">

      <!-- Hero -->
      <section class="mb-10 text-center sm:text-left">
       <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
    Selamat Datang, <span class="text-blue-600">{{ Auth::user()->name }}</span>
    <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-6 h-6 rounded-full">
</h2>

        <p class="text-gray-500 mt-1">
          Kelola data sertifikat siswa dan pantau statistik sistem dengan mudah.
        </p>
      </section>

      <!-- Statistik -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
          $stats = [
            ['title' => 'Total Sertifikat', 'value' => $totalSertifikasi, 'color' => 'from-blue-500 to-blue-700', 'icon' => '📄'],
            ['title' => 'Total Siswa', 'value' => $totalSiswa, 'color' => 'from-orange-400 to-orange-600', 'icon' => '👨‍🎓'],
            ['title' => 'Sertifikat Bulan Ini', 'value' => $totalSertifikatBulanIni, 'color' => 'from-green-500 to-green-700', 'icon' => '📅'],
            ['title' => 'Admin Aktif', 'value' => $totalAdminAktif, 'color' => 'from-purple-500 to-purple-700', 'icon' => '🛠'],
          ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-gradient-to-br {{ $stat['color'] }} rounded-2xl shadow-lg p-6 text-white relative overflow-hidden group hover:scale-105 transition-transform duration-300">
          <div class="absolute right-4 top-4 text-4xl opacity-30 group-hover:opacity-50 transition">{{ $stat['icon'] }}</div>
          <h2 class="text-4xl font-extrabold mb-1">{{ $stat['value'] }}</h2>
          <p class="opacity-90">{{ $stat['title'] }}</p>
        </div>
        @endforeach
      </section>

      <!-- Sertifikat Terbaru -->
      <section class="mb-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
          <h2 class="text-xl font-bold text-blue-800">Sertifikat Terbaru</h2>
          <a href="{{ url('/sertifikat/create') }}"
             class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition">
            + Tambah Sertifikat
          </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white shadow-xl rounded-xl border border-gray-200">
          <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-blue-50 border-b">
              <tr>
                @foreach(['Nama Siswa', 'NIS', 'Jenis Sertifikat', 'Judul Sertifikat', 'Tanggal', 'Sertifikat'] as $header)
                  <th class="px-6 py-3 font-semibold text-blue-800 tracking-wide">{{ $header }}</th>
                @endforeach
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
                    <img src="{{ asset('storage/'.$sertif->foto_sertifikat) }}" alt="Sertifikat"
                         class="w-16 h-16 object-cover rounded-lg shadow-md hover:scale-110 transition">
                  @else
                    <span class="text-gray-400 italic">Tidak ada foto</span>
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
