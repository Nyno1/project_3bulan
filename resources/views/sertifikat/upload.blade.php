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
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white shadow-md rounded-lg p-6 border border-blue-100">
            <div>
                <h2 class="mt-2 text-center text-2xl font-bold text-gray-800">
                    Upload Sertifikat
                </h2>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('sertifikat.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                        <input id="nis" name="nis" type="text" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Masukkan NIS">
                    </div>

                    <div>
                        <label for="foto_sertifikat" class="block text-sm font-medium text-gray-700">Foto Sertifikat</label>
                        <input id="foto_sertifikat" name="foto_sertifikat" type="file" accept="image/*" required
                            class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="pt-6 border-t border-blue-100">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
