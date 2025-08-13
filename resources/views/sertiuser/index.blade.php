<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cari Sertifikat - Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-slideInDown {
            animation: slideInDown 0.5s ease-out;
        }
        
        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease-out;
        }
        
        .animate-slideInRight {
            animation: slideInRight 0.5s ease-out;
        }
        
        .animate-bounceIn {
            animation: bounceIn 0.6s ease-out;
        }
        
        /* Results grid animation */
        .results-enter {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .results-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        /* Loading pulse effect */
        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
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
                class="px-5 py-2 rounded-full border text-white font-medium bg-blue-600 shadow transition">
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
            <button id="searchButton" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-2 rounded-md font-medium transition">
                Cari
            </button>
        </div>
        
        <!-- Loading indicator -->
        <div id="loadingIndicator" class="hidden mt-4">
            <div class="flex justify-center items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="ml-3 text-gray-600 loading-pulse">Mencari...</span>
            </div>
        </div>
    </div>
</section>

<!-- Results Section -->
<section id="resultsSection" class="hidden px-6 pb-20">
    <div class="max-w-6xl mx-auto">
        <div id="resultsHeader" class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Hasil Pencarian</h2>
            <p id="resultsCount" class="text-gray-600"></p>
        </div>
        
        <div id="resultsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Results will be populated here -->
        </div>
        
        <div id="noResults" class="hidden text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada hasil ditemukan</h3>
            <p class="text-gray-500">Coba gunakan kata kunci yang berbeda</p>
        </div>
    </div>
</section>

<!-- Certificate Detail Modal -->
<div id="certificateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div id="modalDialog" class="bg-white rounded-lg max-w-2xl w-full max-h-90vh overflow-y-auto transform scale-95 transition-all duration-300 ease-in-out">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Detail Sertifikat</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl transform hover:scale-110 transition-transform duration-200">&times;</button>
            </div>
            <div id="modalContent">
                <!-- Modal content will be populated here -->
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/a2d9d5a64f.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabNama = document.getElementById('tabNama');
    const tabNis = document.getElementById('tabNis');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const resultsSection = document.getElementById('resultsSection');
    const resultsContainer = document.getElementById('resultsContainer');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');
    const certificateModal = document.getElementById('certificateModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    
    let currentSearchType = 'nama';
    
    // Setup CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    function setActiveTab(activeTab, inactiveTab, placeholder, searchType) {
        // Aktifkan tab yang dipilih
        activeTab.classList.add('bg-blue-600', 'text-white', 'shadow');
        activeTab.classList.remove('hover:bg-gray-100', 'text-gray-700');
        
        // Nonaktifkan tab lainnya
        inactiveTab.classList.remove('bg-blue-600', 'text-white', 'shadow');
        inactiveTab.classList.add('hover:bg-gray-100', 'text-gray-700');
        
        // Ganti placeholder input
        searchInput.setAttribute('placeholder', placeholder);
        searchInput.value = '';
        currentSearchType = searchType;
        
        // Hide results when switching tabs
        resultsSection.classList.add('hidden');
    }
    
    // Tab event listeners
    tabNama.addEventListener('click', () => {
        setActiveTab(tabNama, tabNis, 'Ketik nama siswa...', 'nama');
    });
    
    tabNis.addEventListener('click', () => {
        setActiveTab(tabNis, tabNama, 'Ketik NIS siswa...', 'nis');
    });
    
    // Search function
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        
        if (searchTerm === '') {
            alert('Masukkan kata kunci pencarian');
            return;
        }
        
        // Show loading
        loadingIndicator.classList.remove('hidden');
        resultsSection.classList.add('hidden');
        
        // Make AJAX request
        fetch('{{ route("sertifikat.search.api") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                type: currentSearchType,
                term: searchTerm
            })
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading
            loadingIndicator.classList.add('hidden');
            
            if (data.success) {
                displayResults(data.data, searchTerm);
            } else {
                alert('Error: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadingIndicator.classList.add('hidden');
            alert('Terjadi kesalahan koneksi');
        });
    }
    
    function displayResults(results, searchTerm) {
        resultsContainer.innerHTML = '';
        
        if (results.length === 0) {
            noResults.classList.remove('hidden');
            resultsContainer.classList.add('hidden');
            resultsCount.textContent = 'Tidak ada hasil untuk: "' + searchTerm + '"';
        } else {
            noResults.classList.add('hidden');
            resultsContainer.classList.remove('hidden');
            resultsCount.textContent = 'Ditemukan ' + results.length + ' sertifikat untuk: "' + searchTerm + '"';
            
            // Add stagger animation to results
            results.forEach((cert, index) => {
                setTimeout(() => {
                    const card = createCertificateCard(cert);
                    card.classList.add('results-enter');
                    resultsContainer.appendChild(card);
                    
                    // Trigger animation
                    setTimeout(() => {
                        card.classList.remove('results-enter');
                        card.classList.add('results-enter-active');
                    }, 10);
                }, index * 100); // Stagger delay
            });
        }
        
        resultsSection.classList.remove('hidden');
    }
    
    function createCertificateCard(cert) {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer transform hover:-translate-y-1 hover:scale-105';
        card.onclick = () => showCertificateDetail(cert.id);
        
        card.innerHTML = `
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium animate-pulse">
                        ${cert.jenis_sertifikat}
                    </div>
                    <div class="text-xs text-gray-500">
                        ${new Date(cert.tanggal_diraih).toLocaleDateString('id-ID')}
                    </div>
                </div>
                
                <h3 class="font-bold text-lg text-gray-800 mb-2">${cert.nama_siswa}</h3>
                <p class="text-gray-600 text-sm mb-1">NIS: ${cert.nis}</p>
                
                <div class="mt-4 flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-eye mr-2 transform group-hover:scale-110 transition-transform duration-200"></i>
                    <span class="text-sm font-medium">Lihat Detail</span>
                </div>
            </div>
        `;
        
        return card;
    }
    
    function showCertificateDetail(certId) {
        fetch(`{{ url('/sertifikat') }}/${certId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayCertificateModal(data.data);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil detail');
        });
    }
    
    function displayCertificateModal(cert) {
        modalContent.innerHTML = `
            <div class="space-y-4 opacity-0 animate-fadeInUp">
                <div class="text-center mb-6">
                    <h4 class="text-lg font-bold text-blue-600 mb-2 animate-slideInDown">${cert.jenis_sertifikat}</h4>
                    <div class="bg-gray-100 rounded-lg p-4 transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('storage') }}/${cert.foto_sertifikat}" 
                             alt="Foto Sertifikat" 
                             class="max-w-full h-auto rounded mx-auto shadow-lg hover:shadow-xl transition-shadow duration-300"
                             style="max-height: 300px;">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="animate-slideInLeft">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <p class="text-gray-900 font-semibold bg-gray-50 p-2 ">${cert.nama_siswa}</p>
                    </div>
                    <div class="animate-slideInRight">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                        <p class="text-gray-900 bg-gray-50 p-2">${cert.nis}</p>
                    </div>
                    <div class="animate-slideInLeft" style="animation-delay: 0.1s;">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Sertifikat</label>
                        <p class="text-gray-900 bg-gray-50 p-2">${cert.jenis_sertifikat}</p>
                    </div>
                    <div class="animate-slideInRight" style="animation-delay: 0.1s;">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Diraih</label>
                        <p class="text-gray-900 bg-gray-50 p-2">${new Date(cert.tanggal_diraih).toLocaleDateString('id-ID')}</p>
                    </div>
                </div>
            </div>
        `;
        
        // Show modal with animation
        const modal = certificateModal;
        const dialog = document.getElementById('modalDialog');
        
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-100', 'visible');
        
        dialog.classList.remove('scale-95');
        dialog.classList.add('scale-100');
        
        // Add stagger animation to modal content
        setTimeout(() => {
            const content = modalContent.querySelector('.opacity-0');
            if (content) {
                content.classList.remove('opacity-0');
                content.classList.add('opacity-100');
            }
        }, 100);
    }
    
    // Event listeners
    searchButton.addEventListener('click', performSearch);
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    closeModal.addEventListener('click', () => {
        closeModalWithAnimation();
    });
    
    certificateModal.addEventListener('click', function(e) {
        if (e.target === certificateModal) {
            closeModalWithAnimation();
        }
    });
    
    // Function to close modal with animation
    function closeModalWithAnimation() {
        const modal = certificateModal;
        const dialog = document.getElementById('modalDialog');
        
        dialog.classList.remove('scale-100');
        dialog.classList.add('scale-95');
        
        modal.classList.remove('opacity-100', 'visible');
        modal.classList.add('opacity-0', 'invisible');
    }
    
    // Add escape key support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !certificateModal.classList.contains('invisible')) {
            closeModalWithAnimation();
        }
    });
});
</script>
</body>
</html>