<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans transition-colors duration-300">

@include('profile.partials.navbar-user')

<!-- Search Section -->
<section class="pt-32 pb-20 px-6">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-3">Cari Sertifikat Siswa</h1>
        <p class="text-gray-500 mb-8">Temukan sertifikat siswa berdasarkan nama atau NIS</p>

        <!-- Tabs -->
        <div class="flex justify-center gap-4 mb-6">
            <button id="tabNama" 
                class="px-5 py-2 rounded-full border text-gray-700 font-medium bg-blue-600 shadow transition">
                <i class="fas fa-user mr-2"></i> Nama Siswa
            </button>
            <button id="tabNis" 
                class="px-5 py-2 rounded-full border text-gray-700 hover:bg-gray-100 font-medium transition">
                <i class="fas fa-id-card mr-2"></i> NIS
            </button>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center gap-2 bg-white p-2 rounded-lg shadow-md">
            <div class="flex items-center w-full">
                <span class="text-gray-400 px-3">
                    <i class="fas fa-search"></i>
                </span>
                <input 
                    id="searchInput"
                    type="text" 
                    placeholder="Ketik nama siswa..."
                    class="w-full border-0 focus:ring-0 text-gray-700 placeholder-gray-400"
                >
            </div>
            <button class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-2 rounded-md font-medium transition">
                Cari
            </button>
        </div>
    </div>
</section>

<script src="https://kit.fontawesome.com/a2d9d5a64f.js" crossorigin="anonymous"></script>
<script>
    const tabNama = document.getElementById('tabNama');
    const tabNis = document.getElementById('tabNis');
    const searchInput = document.getElementById('searchInput');

    function setActiveTab(activeTab, inactiveTab, placeholder) {
        // Aktifkan tab yang dipilih
        activeTab.classList.add('bg-blue-600', 'text-white', 'shadow');
        activeTab.classList.remove('hover:bg-gray-100', 'text-gray-700');

        // Nonaktifkan tab lainnya
        inactiveTab.classList.remove('bg-blue-600', 'text-white', 'shadow');
        inactiveTab.classList.add('hover:bg-gray-100', 'text-gray-700');

        // Ganti placeholder input
        searchInput.setAttribute('placeholder', placeholder);
    }

    tabNama.addEventListener('click', () => {
        setActiveTab(tabNama, tabNis, 'Ketik nama siswa...');
    });

    tabNis.addEventListener('click', () => {
        setActiveTab(tabNis, tabNama, 'Ketik NIS siswa...');
    });
</script>

</body>
</html>
