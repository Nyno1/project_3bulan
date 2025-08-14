<x-app-layout>
  <body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Hero -->
    <main class="pt-28 px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto">
      <section class="mb-10">
        <h1 class="text-3xl font-bold text-blue-800 mb-2">Selamat Datang, <span>{{ Auth::user()->name }}</span> 👋</h1>
        <p class="text-gray-600">Kelola data sertifikat siswa dan lihat statistik sistem secara ringkas.</p>
      </section>

      <!-- Statistik -->
     <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-600">
        <h2 class="text-2xl font-semibold text-blue-900">{{ $totalSertifikasi }}</h2>
        <p class="text-gray-500">Total Sertifikat</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
        <h2 class="text-2xl font-semibold text-blue-900">{{ $totalSiswa }}</h2>
        <p class="text-gray-500">Total Siswa</p>
    </div>

</section>


      <!-- Aksi -->
      <section class="mb-10">
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
    <h2 class="text-xl font-semibold text-blue-800">Sertifikat Terbaru</h2>
    <a href="{{ url('/sertifikat/create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
        + Tambah Sertifikat
    </a>
</div>


        <!-- Tabel Sertifikat -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
          <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-50 border-b">
              <tr>
                <th class="px-6 py-3 text-blue-800 font-semibold">Nama Siswa</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">NIS</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">Jenis Sertifikat</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">Judul Sertifikat</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">tanggal</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">sertifikat</th>
              </tr>
            </thead>
            <tbody>
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
                <img src="{{ asset('storage/'.$sertif->foto_sertifikat) }}" alt="Sertifikat" class="w-16 h-16 object-cover rounded">
            @else
                <span class="text-gray-500">Tidak ada foto</span>
            @endif

        </td>
    </tr>
    @endforeach
</tbody>

            </tbody>
          </table>
        </div>
      </section>
    </main>

    @include('profile.partials.footer')
  </body>
</x-app-layout>
