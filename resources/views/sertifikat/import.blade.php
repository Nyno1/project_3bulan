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

        <div class="relative py-12 min-h-screen bg-gradient-to-br from-indigo-100 via-white to-blue-100 overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png')]"></div>
            <div class="absolute -top-20 -left-20 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute inset-0">
                <img src="/images/pattern.png" alt="Background Pattern" class="w-full h-full object-cover opacity-20 pointer-events-none">
            </div>

            <div class="relative w-full max-w-3xl sm:px-6 lg:px-8">
                <div class="backdrop-blur-xl bg-white/80 border border-transparent bg-clip-padding rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 p-[1px] bg-gradient-to-r from-indigo-200 to-blue-200">
                    <div class="p-8 sm:px-16 bg-white/90 rounded-2xl">
                        
                        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center tracking-wide">
                            Unggah File Excel Sertifikat
                        </h2>

                        {{-- Alert Success --}}
                        @if (session('success'))
                            <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded-xl relative mb-6 shadow-sm animate-fade-in">
                                <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                            </div>
                        @endif

                        {{-- Alert Error --}}
                        @if (session('error'))
                            <div class="bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-xl relative mb-6 shadow-sm animate-fade-in">
                                <span class="block sm:inline font-semibold">{{ session('error') }}</span>
                            </div>
                        @endif

                        {{-- Form Import --}}
                        <form action="{{ route('sertifikat.import.excel') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                                        <path fill="#185c37" d="M42,4H14c-1.1,0-2,0.9-2,2v36c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2V6C44,4.9,43.1,4,42,4z" />
                                        <path fill="#21a366" d="M14 4h14v40H14z" />
                                        <path fill="#fff" d="M24.5 29.5h-3.6l-2.5-4.5-2.5 4.5H12l4-7-4-7h3.9l2.5 4.5 2.5-4.5h3.6l-4 7z" />
                                    </svg>
                                    Pilih File Excel
                                </label>

                                <input type="file" name="file" id="file"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white/80 focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3 shadow-sm hover:shadow-md transition-all duration-200"
                                    required>
                                @error('file')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <a href="{{ route('sertifikat.import.template') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gray-500 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200 mr-4">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Unduh Template
                                </a>

                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Import Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-5px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-fade-in {
                animation: fade-in 0.4s ease-out;
            }
        </style>
    </div>
</x-app-layout>