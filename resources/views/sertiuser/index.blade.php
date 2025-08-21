<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cari Sertifikat - Certisat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 text-gray-800 font-sans transition-colors duration-300 bg-pattern">
        @include('profile.partials.navbar-user')

        <!-- Background animation -->
        <canvas id="bgCanvas" class="absolute inset-0 w-full h-full z-0"></canvas>

        <!-- Floating decoration elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full opacity-10 animate-floating"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-gradient-to-br from-pink-400 to-yellow-400 rounded-full opacity-10 animate-floating" style="animation-delay: -1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-gradient-to-br from-green-400 to-blue-500 rounded-full opacity-10 animate-floating" style="animation-delay: -2s;"></div>

        <!-- Content wrapper -->
        <div class="relative z-10">
            <!-- Search Section -->
            <section class="pt-32 pb-20 px-6">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl font-bold gradient-text mb-4 animate-slideInDown">Cari Sertifikat Siswa</h1>
                    <p class="text-gray-600 mb-8 text-lg animate-fadeInUp" style="animation-delay: 0.2s;">Temukan sertifikat siswa berdasarkan nama atau NIS</p>
                    
                    <!-- Tabs -->
                    <div class="flex justify-center gap-4 mb-8 animate-fadeInUp" style="animation-delay: 0.4s;">
                        <button id="tabNama" 
                            class="tab-enhanced active px-6 py-3 rounded-full text-gray-700 font-medium shadow-lg transition">
                            <i class="fas fa-user mr-2"></i> Nama Siswa
                        </button>
                        <button id="tabNis" 
                            class="tab-enhanced px-6 py-3 rounded-full text-gray-700 font-medium shadow-lg transition">
                            <i class="fas fa-id-card mr-2"></i> NIS
                        </button>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="search-container flex items-center gap-3 p-3 rounded-2xl animate-fadeInUp" style="animation-delay: 0.6s;">
                        <div class="flex items-center w-full">
                            <span class="text-gray-400 px-4 text-lg">
                                <i class="fas fa-search"></i>
                            </span>
                            <input 
                                id="searchInput"
                                type="text" 
                                placeholder="Ketik nama siswa..."
                                class="input-enhanced w-full border-0 focus:ring-0 text-gray-700 placeholder-gray-400 rounded-lg p-2"
                            >
                        </div>
                        <button id="searchButton" class="btn-enhanced text-white text-center px-8 py-3 rounded-xl font-medium transition transform hover:scale-105">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                    
                    <!-- Loading indicator -->
                    <div id="loadingIndicator" class="hidden mt-6 animate-bounceIn">
                        <div class="flex justify-center items-center">
                            <div class="animate-spin rounded-full h-10 w-10 border-b-3 border-blue-600"></div>
                            <span class="ml-4 text-gray-600 loading-pulse text-lg">Mencari...</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Results Section -->
        <section id="resultsSection" class="hidden px-6 pb-20">
            <div class="max-w-6xl mx-auto">
                <div id="resultsHeader" class="mb-8 text-center">
                    <h2 class="text-3xl font-bold gradient-text mb-3">Hasil Pencarian</h2>
                    <p id="resultsCount" class="text-gray-600 text-lg"></p>
                </div>
                
                <div id="resultsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Results will be populated here -->
                </div>
                
                <div id="noResults" class="hidden text-center py-16">
                    <div class="text-gray-300 mb-6 animate-bounceIn">
                        <i class="fas fa-search text-8xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-3">Tidak ada hasil ditemukan</h3>
                    <p class="text-gray-500 text-lg">Coba gunakan kata kunci yang berbeda</p>
                </div>
            </div>
        </section>

        <!-- Certificate Detail Modal -->
        <div id="certificateModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 opacity-0 invisible transition-all duration-300 ease-in-out backdrop-blur-sm">
            <div id="modalDialog" class="modal-enhanced rounded-2xl max-w-2xl w-full max-h-90vh overflow-y-auto transform scale-95 transition-all duration-300 ease-in-out">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold gradient-text">Detail Sertifikat</h3>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600 text-3xl transform hover:scale-110 hover:rotate-90 transition-all duration-300">&times;</button>
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
                activeTab.classList.add('active');
                inactiveTab.classList.remove('active');
                
                // Ganti placeholder input
                searchInput.setAttribute('placeholder', placeholder);
                searchInput.value = '';
                currentSearchType = searchType;
                
                // Hide results when switching tabs
                resultsSection.classList.add('hidden');
            }
            
            // Tab event listeners
            tabNama.addEventListener('click', () => {
                setActiveTab(tabNama, tabNis, 'Masukan nama siswa...', 'nama');
            });
            
            tabNis.addEventListener('click', () => {
                setActiveTab(tabNis, tabNama, 'Masukan NIS siswa...', 'nis');
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
                card.className = 'card-enhanced rounded-2xl overflow-hidden cursor-pointer group';
                card.onclick = () => showCertificateDetail(cert.id);
                
                card.innerHTML = `
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="cert-badge text-white px-4 py-2 rounded-full text-sm font-semibold animate-glow">
                                ${cert.jenis_sertifikat}
                            </div>
                            <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                ${new Date(cert.tanggal_diraih).toLocaleDateString('id-ID')}
                            </div>
                        </div>
                        
                        <h3 class="font-bold text-xl text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">${cert.nama_siswa}</h3>
                        <p class="text-gray-600 text-sm mb-4 bg-gray-50 px-3 py-2 rounded-lg">NIS: ${cert.nis}</p>
                        
                        <div class="mt-6 flex items-center text-blue-600 hover:text-blue-800 transition-all duration-300 group-hover:transform group-hover:translate-x-2">
                            <i class="fas fa-eye mr-3 text-lg transform group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="font-semibold">Lihat Detail</span>
                            <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
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
                    <div class="space-y-6 opacity-0 animate-fadeInUp">
                        <div class="text-center mb-8">
                            <h4 class="text-2xl font-bold gradient-text mb-4 animate-slideInDown">${cert.jenis_sertifikat}</h4>
                            <div class="neumorphism rounded-2xl p-6 transform hover:scale-105 transition-transform duration-500">
                                <img src="{{ asset('storage') }}/${cert.foto_sertifikat}" 
                                    alt="Foto Sertifikat" 
                                    class="max-w-full h-auto rounded-xl mx-auto shadow-2xl hover:shadow-blue-500/25 transition-shadow duration-500"
                                    style="max-height: 300px;">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="animate-slideInLeft neumorphism-inset rounded-xl p-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Siswa</label>
                                <p class="text-gray-900 font-bold text-lg">${cert.nama_siswa}</p>
                            </div>
                            <div class="animate-slideInRight neumorphism-inset rounded-xl p-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIS</label>
                                <p class="text-gray-900 text-lg">${cert.nis}</p>
                            </div>
                            <div class="animate-slideInLeft neumorphism-inset rounded-xl p-4" style="animation-delay: 0.1s;">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Sertifikat</label>
                                <p class="text-gray-900 text-lg">${cert.jenis_sertifikat}</p>
                            </div>
                            <div class="animate-slideInRight neumorphism-inset rounded-xl p-4" style="animation-delay: 0.1s;">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Diraih</label>
                                <p class="text-gray-900 text-lg">${new Date(cert.tanggal_diraih).toLocaleDateString('id-ID')}</p>
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