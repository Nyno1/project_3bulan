<footer class="bg-blue-900 text-white mt-16">
    <div class="max-w-screen-xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Info Sekolah -->
        <div>
            <h2 class="text-xl font-semibold mb-2">SMK Informatika Pesat</h2>
            <p class="text-sm text-blue-300">
                Platform manajemen sertifikat online untuk melihat sertifikasi yang sudah anda miliki dan diverifikasi langsung oleh industri.
            </p>
        </div>

        <!-- Navigasi -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Navigasi</h2>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-yellow-400 transition">Beranda</a></li>
                <li><a href="{{ url('/certificates') }}" class="hover:text-yellow-400 transition">Sertifikasi</a></li>
            </ul>
        </div>

        <!-- Sosial Media -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Terhubung</h2>
            <div class="flex space-x-4 mt-2 text-2xl">
                <a href="https://smkpesat.sch.id/" target="_blank">🌐</a>
                <a href="#">🐦</a>
                <a href="#">📘</a>
            </div>
            <p class="text-sm text-blue-300 mt-4">Dibuat oleh Tim RPL SMK Informatika Pesat</p>
        </div>
    </div>

    <div class="text-center text-blue-400 border-t border-blue-800 py-4 text-sm">
        © 2025 SMK Informatika Pesat - Certificate Management System. All rights reserved.
    </div>
</footer>
