<!-- Tambahkan ini di dalam <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<footer class="bg-blue-900 text-white">
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
                <li><a href="#beranda" class="hover:text-yellow-400 transition">Beranda</a></li>
                <li><a href="{{ route('pencarian.sertifikat') }}" class="hover:text-yellow-400 transition">Sertifikasi</a></li>
            </ul>
        </div>

        <!-- Sosial Media -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Terhubung</h2>
            <div class="flex space-x-4 mt-2 text-2xl">
                <a href="https://smkpesat.sch.id/" target="_blank" class="hover:text-yellow-400 transition">
                    <i class="fas fa-globe"></i>
                </a>
                <a href="https://www.instagram.com/smkpesat_itxpro/" target="_blank" class="hover:text-yellow-400 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/people/SMK-Informatika-Pesat-It-XPro/100092495414821/" target="_blank" class="hover:text-yellow-400 transition">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
            <p class="text-sm text-blue-300 mt-4">Dibuat oleh Tim RPL SMK Informatika Pesat</p>
        </div>
    </div>

    <div class="text-center text-blue-400 border-t border-blue-800 py-4 text-sm">
        © 2025 SMK Informatika Pesat - Certificate Management System. All rights reserved.
    </div>
</footer>
