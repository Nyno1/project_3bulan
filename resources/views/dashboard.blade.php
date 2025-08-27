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
    class="transition-all duration-300 ease-in-out"
  >
    <body class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-50 relative overflow-hidden">
      <div class="fixed inset-0 opacity-200 pointer-events-none">
        <div class="absolute inset-0">
          <img src="/images/pattern.png" alt="Background Pattern" class="w-full h-full object-cover opacity-20 pointer-events-none">
        </div>
        
      </div>

      <main class="relative pt-28 px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto">
        {{-- Alert Messages --}}
        @if(session('error'))
          <div class="mb-8 relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-6 shadow-lg backdrop-blur-sm">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-pink-400"></div>
            <div class="flex items-center gap-3">
              <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                  <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="font-semibold text-red-800">Error!</h4>
                <p class="text-red-700">{{ session('error') }}</p>
              </div>
            </div>
          </div>
        @endif

        @if(session('success'))
          <div class="mb-8 relative overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 p-6 shadow-lg backdrop-blur-sm">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-green-400"></div>
            <div class="flex items-center gap-3">
              <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                  <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="font-semibold text-emerald-800">Success!</h4>
                <p class="text-emerald-700">{{ session('success') }}</p>
              </div>
            </div>
          </div>
        @endif

        {{-- Hero Section --}}
        <section class="mb-12">
          <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 p-8 sm:p-12 text-white shadow-2xl">
            <div class="absolute inset-0 opacity-10">
              <svg class="w-full h-full" viewBox="0 0 100 100" fill="none">
                <defs>
                  <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                  </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
              </svg>
            </div>
            
            <div class="relative z-10">
              <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                  <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                      </svg>
                    </div>
                    <div>
                      <h1 class="text-3xl sm:text-4xl font-bold">Selamat Datang,</h1>
                      <p class="text-xl sm:text-2xl font-medium text-blue-100">{{ Auth::user()->name }}</p>
                    </div>
                  </div>
                  <p class="text-blue-100 text-lg max-w-2xl leading-relaxed">
                    Kelola data sertifikat siswa dan pantau statistik sistem dengan mudah melalui dashboard admin yang modern dan intuitif.
                  </p>
                </div>
                <div class="mt-6 lg:mt-0">
                  <div class="flex items-center gap-2 text-sm text-blue-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="current-time"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {{-- Statistics Cards --}}
        <section class="mb-12">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
              $stats = [
                [
                  'title' => 'Total Sertifikat', 
                  'value' => $totalSertifikasi ?? 0, 
                  'gradient' => 'from-blue-500 via-blue-600 to-blue-700', 
                  'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                  'changeType' => 'increase'
                ],
                [
                  'title' => 'Total Siswa', 
                  'value' => $totalSiswa ?? 0, 
                  'gradient' => 'from-emerald-500 via-emerald-600 to-green-700', 
                  'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                  'changeType' => 'increase'
                ],
                [
                  'title' => 'Sertifikat Bulan Ini', 
                  'value' => $totalSertifikatBulanIni ?? 0, 
                  'gradient' => 'from-purple-500 via-purple-600 to-indigo-700', 
                  'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>',
                  'changeType' => 'increase'
                ],
                [
                  'title' => 'Admin Aktif', 
                  'value' => $totalAdminAktif ?? 0, 
                  'gradient' => 'from-orange-500 via-orange-600 to-red-600', 
                  'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                  'changeType' => 'increase'
                ]
              ];
            @endphp

            @foreach($stats as $stat)
              <div class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r {{ $stat['gradient'] }} rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r {{ $stat['gradient'] }} rounded-xl flex items-center justify-center text-white shadow-lg">
                          {!! $stat['icon'] !!}
                        </div>
                        <div class="text-right">
                          <div class="text-3xl font-bold text-gray-800 mb-1">{{ number_format($stat['value']) }}</div>
                        </div>
                      </div>
                      <h3 class="text-sm font-semibold text-gray-600 leading-tight">{{ $stat['title'] }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </section>

        {{-- Data Siswa --}}
        <section class="mb-10">
          <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-8 py-6 border-b border-gray-100">
              <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                  </div>
                  <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Siswa</h2>
                    <p class="text-gray-600 mt-1">Kelola dan lihat detail sertifikat siswa</p>
                  </div>
                </div>
                <a href="{{ route('tambah.sertifikat') }}" 
                   class="group relative inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                  <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 rounded-xl transition-opacity duration-200"></div>
                  <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                  </svg>
                  <span class="font-semibold relative z-10">Tambah Siswa</span>
                </a>
              </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-slate-50">
                  <tr>
                    <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                      Nama Siswa
                    </th>
                    <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                      NIS
                    </th>
                    <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                      Jumlah Sertifikat
                    </th>
                    <th scope="col" class="px-6 py-5 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  @forelse ($siswas as $s)
                    <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                      <td class="px-8 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-400 to-indigo-500 flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-200">
                              <span class="text-white font-bold text-sm">
                                {{ strtoupper(substr($s->nama, 0, 2)) }}
                              </span>
                            </div>
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-200">
                              {{ $s->nama }}
                            </div>
                            <div class="text-sm text-gray-500">Student</div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-6 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $s->nis }}</div>
                        <div class="text-sm text-gray-500">NIS</div>
                      </td>
                      <td class="px-6 py-6 whitespace-nowrap">
                        @php $certCount = $s->sertifikats()->count(); @endphp
                        <div class="flex items-center gap-2">
                          <span class="px-4 py-2 inline-flex items-center gap-2 text-sm font-semibold rounded-full {{ $certCount > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} shadow-sm">
                            @if($certCount > 0)
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                              </svg>
                            @endif
                            {{ $certCount }} Sertifikat
                          </span>
                        </div>
                      </td>
                      <td class="px-6 py-6 whitespace-nowrap text-center">
                        <a href="{{ route('siswa.detail', $s->id) }}" 
                           class="group/btn relative inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-700 hover:text-blue-800 text-sm font-semibold rounded-xl border border-blue-200 hover:border-blue-300 shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                          <svg class="w-4 h-4 mr-2 group-hover/btn:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                          </svg>
                          Detail
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                          <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-slate-100 rounded-full flex items-center justify-center mb-4 shadow-inner">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                          </div>
                          <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Data Siswa</h3>
                          <p class="text-gray-500 mb-4">Mulai tambahkan data siswa untuk mengelola sertifikat mereka.</p>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            @if($siswas->hasPages())
              <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-8 py-6 border-t border-gray-100">
                <div class="flex items-center justify-between">
                  <div class="text-sm text-gray-600">
                    Menampilkan {{ $siswas->firstItem() }} - {{ $siswas->lastItem() }} dari {{ $siswas->total() }} siswa
                  </div>
                  <div class="pagination-wrapper">
                    {{ $siswas->links() }}
                  </div>
                </div>
              </div>
            @endif
          </div>
        </section>

      </main>

      <!-- JavaScript for real-time clock -->
      <script>
        function updateTime() {
          const now = new Date();
          const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
          };
          document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }
        
        updateTime();
        setInterval(updateTime, 1000);
      </script>

      <style>
        .pagination-wrapper .pagination {
          display: flex;
          align-items: center;
          gap: 0.5rem;
        }
        
        .pagination-wrapper .pagination li {
          list-style: none;
        }
        
        .pagination-wrapper .pagination a,
        .pagination-wrapper .pagination span {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 2.5rem;
          height: 2.5rem;
          font-size: 0.875rem;
          font-weight: 500;
          border-radius: 0.75rem;
          transition: all 0.2s;
        }
        
        .pagination-wrapper .pagination a {
          background: white;
          border: 1px solid #e5e7eb;
          color: #6b7280;
        }
        
        .pagination-wrapper .pagination a:hover {
          background: linear-gradient(to right, #3b82f6, #6366f1);
          color: white;
          transform: translateY(-1px);
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .pagination-wrapper .pagination .active span {
          background: linear-gradient(to right, #3b82f6, #6366f1);
          color: white;
          box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }
      </style>
    </body>
  </div>
</x-app-layout>