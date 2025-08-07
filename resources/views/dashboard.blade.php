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
          <h2 class="text-2xl font-semibold text-blue-900">120</h2>
          <p class="text-gray-500">Total Sertifikat</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
          <h2 class="text-2xl font-semibold text-blue-900">75</h2>
          <p class="text-gray-500">Total Siswa</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
          <h2 class="text-2xl font-semibold text-blue-900">10</h2>
          <p class="text-gray-500">Perusahaan Penilai</p>
        </div>
      </section>

      <!-- Aksi -->
      <section class="mb-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
          <h2 class="text-xl font-semibold text-blue-800">Sertifikat Terbaru</h2>
          <button onclick="alert('Form tambah belum aktif')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah Sertifikat
          </button>
        </div>

        <!-- Tabel Sertifikat -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
          <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-50 border-b">
              <tr>
                <th class="px-6 py-3 text-blue-800 font-semibold">Nama Siswa</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">NIS</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">Judul Sertifikat</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">Perusahaan</th>
                <th class="px-6 py-3 text-blue-800 font-semibold">Tahun</th>
              </tr>
            </thead>
            <tbody>
              @php
                $dummyData = [
                  ['nama' => 'Rizky Ramadhan', 'nis' => '123456', 'judul' => 'Sertifikasi Laravel', 'perusahaan' => 'PT. Devtech', 'tahun' => '2025'],
                  ['nama' => 'Nadia Zahra', 'nis' => '123457', 'judul' => 'Sertifikasi UI/UX', 'perusahaan' => 'CV. Kreatif', 'tahun' => '2025'],
                  ['nama' => 'Fauzan Malik', 'nis' => '123458', 'judul' => 'Sertifikasi Database', 'perusahaan' => 'PT. DataCorp', 'tahun' => '2025'],
                ];
              @endphp

              @foreach ($dummyData as $sertif)
              <tr class="border-b hover:bg-gray-50 transition">
                <td class="px-6 py-4">{{ $sertif['nama'] }}</td>
                <td class="px-6 py-4">{{ $sertif['nis'] }}</td>
                <td class="px-6 py-4">{{ $sertif['judul'] }}</td>
                <td class="px-6 py-4">{{ $sertif['perusahaan'] }}</td>
                <td class="px-6 py-4">{{ $sertif['tahun'] }}</td>
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
