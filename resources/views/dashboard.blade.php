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
  <body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 font-sans">
    <main class="pt-28 px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto">

      {{-- Alert Error --}}
      @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-300 text-red-700 shadow-md">
          <strong>⚠️ {{ session('error') }}</strong>
        </div>
      @endif
      @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-300 text-green-700 shadow-md">
          <strong>✅ {{ session('success') }}</strong>
        </div>
      @endif

      {{-- Hero --}}
      <section class="mb-10 text-center sm:text-left">
        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
          <h2 class="text-2xl font-bold text-gray-800">Selamat Datang,</h2>
          <span class="text-2xl font-bold text-blue-600">{{ Auth::user()->name }}</span>
        </div>
        <p class="text-gray-500 mt-1">
          Kelola data sertifikat siswa dan pantau statistik sistem dengan mudah.
        </p>
      </section>

      {{-- Statistik --}}
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
          $stats = [
            ['title' => 'Total Sertifikat', 'value' => $totalSertifikasi ?? 0, 'color' => 'from-blue-500 to-blue-700', 'icon' => '📄'],
            ['title' => 'Total Siswa', 'value' => $totalSiswa ?? 0, 'color' => 'from-orange-400 to-orange-600', 'icon' => '👨‍🎓'],
            ['title' => 'Sertifikat Bulan Ini', 'value' => $totalSertifikatBulanIni ?? 0, 'color' => 'from-green-500 to-green-700', 'icon' => '📅'],
            ['title' => 'Admin Aktif', 'value' => $totalAdminAktif ?? 0, 'color' => 'from-purple-500 to-purple-700', 'icon' => '🛠'],
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

      {{-- Sertifikat Terbaru --}}
    <section class="mb-10">
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-xl font-bold text-blue-800">Data Siswa</h2>
      <p class="text-sm text-gray-500 mt-1">Kelola dan lihat detail sertifikat siswa</p>
    </div>
    <a href="#" 
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
      </svg>
      Tambah Siswa
    </a>
  </div>

  <div class="overflow-hidden bg-white shadow-xl rounded-xl border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Nama
          </th>
          <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            NIS
          </th>
          <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Jumlah Sertifikat
          </th>
          <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Action
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($siswas as $s)
          <tr class="hover:bg-gray-50 transition-colors duration-200">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600 font-medium text-sm">
                      {{ strtoupper(substr($s->nama, 0, 2)) }}
                    </span>
                  </div>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">
                    {{ $s->nama }}
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $s->nis }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $s->sertifikats()->count() > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $s->sertifikats()->count() }} Sertifikat
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
              <a href="{{ route('siswa.detail', $s->id) }}" 
                 class="inline-flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium rounded-lg transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-10 text-center">
              <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <span class="mt-2 text-gray-500">Tidak ada data siswa.</span>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    {{ $siswas->links() }}
  </div>
</section>

    </main>
  </body>
</x-app-layout>