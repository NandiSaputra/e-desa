<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Administratif - Digital Village Admin</title>
   @vite(['resources/css/app.css', 'resources/css/dashboard_admin.css', 'resources/js/app.js'])
   <style>
    [x-cloak] { display: none !important; }
</style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fdigitalvi1167back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.6"></script>
</head>
<body class="bg-background min-h-screen">
  
@include('dashboard.admin.utility.navbar')
    <!-- Main Layout -->
    <div class="flex pt-20">
        <!-- Sidebar Navigation -->
        <nav class="w-64 bg-surface shadow-custom-sm border-r border-border-light fixed left-0 top-20 bottom-0 overflow-y-auto">
            <div class="p-6">
                <ul class="space-y-2">
                    <li>
                        <a href="administrative_dashboard.html" class="flex items-center space-x-3 px-4 py-3 text-primary bg-primary-50 rounded-lg font-medium">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="family_card_management.html" class="flex items-center space-x-3 px-4 py-3 text-text-secondary hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <i class="fas fa-users w-5"></i>
                            <span>Kartu Keluarga</span>
                        </a>
                    </li>
                    <li>
                        <a href="resident_data_management.html" class="flex items-center space-x-3 px-4 py-3 text-text-secondary hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <i class="fas fa-user-friends w-5"></i>
                            <span>Data Warga</span>
                        </a>
                    </li>
                    <li>
                        <a href="umkm_business_registry.html" class="flex items-center space-x-3 px-4 py-3 text-text-secondary hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <i class="fas fa-store w-5"></i>
                            <span>UMKM</span>
                        </a>
                    </li>
                    <li>
                        <a href="news_content_management.html" class="flex items-center space-x-3 px-4 py-3 text-text-secondary hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <i class="fas fa-newspaper w-5"></i>
                            <span>Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="letter_request_processing.html" class="flex items-center space-x-3 px-4 py-3 text-text-secondary hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <i class="fas fa-file-alt w-5"></i>
                            <span>Surat Permohonan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-6">
            <!-- Quick Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Population Card -->
                <div class="card hover:shadow-custom-md transition-shadow cursor-pointer" onclick="window.location.href='resident_data_management.html'">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-text-secondary text-sm font-medium">Total Penduduk</p>
                            <p class="text-3xl font-heading font-semibold text-text-primary mt-1">2,847</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-success text-sm mr-1"></i>
                                <span class="text-success text-sm font-medium">+2.3%</span>
                                <span class="text-text-secondary text-sm ml-1">bulan ini</span>
                            </div>
                        </div>
                        <div class="bg-primary-100 p-4 rounded-xl">
                            <i class="fas fa-users text-primary text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Family Cards -->
                <div class="card hover:shadow-custom-md transition-shadow cursor-pointer" onclick="window.location.href='family_card_management.html'">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-text-secondary text-sm font-medium">Kartu Keluarga</p>
                            <p class="text-3xl font-heading font-semibold text-text-primary mt-1">892</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-success text-sm mr-1"></i>
                                <span class="text-success text-sm font-medium">+1.8%</span>
                                <span class="text-text-secondary text-sm ml-1">bulan ini</span>
                            </div>
                        </div>
                        <div class="bg-secondary-100 p-4 rounded-xl">
                            <i class="fas fa-id-card text-secondary text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- UMKM Businesses -->
                <div class="card hover:shadow-custom-md transition-shadow cursor-pointer" onclick="window.location.href='umkm_business_registry.html'">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-text-secondary text-sm font-medium">UMKM Terdaftar</p>
                            <p class="text-3xl font-heading font-semibold text-text-primary mt-1">156</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-success text-sm mr-1"></i>
                                <span class="text-success text-sm font-medium">+5.2%</span>
                                <span class="text-text-secondary text-sm ml-1">bulan ini</span>
                            </div>
                        </div>
                        <div class="bg-accent-100 p-4 rounded-xl">
                            <i class="fas fa-store text-accent text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Letter Requests -->
                <div class="card hover:shadow-custom-md transition-shadow cursor-pointer" onclick="window.location.href='letter_request_processing.html'">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-text-secondary text-sm font-medium">Surat Pending</p>
                            <p class="text-3xl font-heading font-semibold text-text-primary mt-1">23</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-clock text-warning text-sm mr-1"></i>
                                <span class="text-warning text-sm font-medium">Perlu Review</span>
                            </div>
                        </div>
                        <div class="bg-warning-100 p-4 rounded-xl">
                            <i class="fas fa-file-alt text-warning text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Population Trends Chart -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-heading font-semibold text-text-primary">Tren Populasi</h3>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm bg-primary-100 text-primary rounded-lg">6 Bulan</button>
                            <button class="px-3 py-1 text-sm text-text-secondary hover:bg-gray-100 rounded-lg">1 Tahun</button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="populationChart"></canvas>
                    </div>
                </div>

                <!-- Service Requests Chart -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-heading font-semibold text-text-primary">Permohonan Layanan</h3>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm bg-primary-100 text-primary rounded-lg">Bulan Ini</button>
                            <button class="px-3 py-1 text-sm text-text-secondary hover:bg-gray-100 rounded-lg">Tahun Ini</button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="serviceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <div class="lg:col-span-2 card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-heading font-semibold text-text-primary">Aktivitas Terbaru</h3>
                        <a href="javascript:void(0)" class="text-primary hover:text-primary-600 text-sm font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 p-4 bg-primary-50 rounded-lg">
                            <div class="bg-primary text-white p-2 rounded-lg">
                                <i class="fas fa-user-plus text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-text-primary">Pendaftaran Warga Baru</p>
                                <p class="text-sm text-text-secondary">Siti Aminah telah terdaftar sebagai warga baru</p>
                                <p class="text-xs text-text-secondary mt-1">2 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 bg-accent-50 rounded-lg">
                            <div class="bg-accent text-white p-2 rounded-lg">
                                <i class="fas fa-store text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-text-primary">UMKM Baru Terdaftar</p>
                                <p class="text-sm text-text-secondary">Warung Makan Sederhana - Kategori Kuliner</p>
                                <p class="text-xs text-text-secondary mt-1">4 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 bg-warning-50 rounded-lg">
                            <div class="bg-warning text-white p-2 rounded-lg">
                                <i class="fas fa-file-alt text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-text-primary">Surat Permohonan Baru</p>
                                <p class="text-sm text-text-secondary">Permohonan Surat Domisili dari Ahmad Wijaya</p>
                                <p class="text-xs text-text-secondary mt-1">6 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <h3 class="text-lg font-heading font-semibold text-text-primary mb-6">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="family_card_management.html" class="flex items-center space-x-3 p-3 bg-primary-50 hover:bg-primary-100 rounded-lg transition-colors">
                            <i class="fas fa-plus text-primary"></i>
                            <span class="text-sm font-medium text-primary">Tambah Kartu Keluarga</span>
                        </a>
                        <a href="resident_data_management.html" class="flex items-center space-x-3 p-3 bg-secondary-50 hover:bg-secondary-100 rounded-lg transition-colors">
                            <i class="fas fa-user-plus text-secondary"></i>
                            <span class="text-sm font-medium text-secondary">Daftar Warga Baru</span>
                        </a>
                        <a href="umkm_business_registry.html" class="flex items-center space-x-3 p-3 bg-accent-50 hover:bg-accent-100 rounded-lg transition-colors">
                            <i class="fas fa-store text-accent"></i>
                            <span class="text-sm font-medium text-accent">Daftar UMKM</span>
                        </a>
                        <a href="news_content_management.html" class="flex items-center space-x-3 p-3 bg-success-50 hover:bg-success-100 rounded-lg transition-colors">
                            <i class="fas fa-newspaper text-success"></i>
                            <span class="text-sm font-medium text-success">Publikasi Berita</span>
                        </a>
                    </div>

                    <!-- System Status -->
                    <div class="mt-6 pt-6 border-t border-border-light">
                        <h4 class="text-sm font-medium text-text-primary mb-3">Status Sistem</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-text-secondary">Database</span>
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 bg-success rounded-full"></div>
                                    <span class="text-xs text-success">Online</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-text-secondary">Backup</span>
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 bg-success rounded-full"></div>
                                    <span class="text-xs text-success">Terbaru</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-text-secondary">Sinkronisasi</span>
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 bg-warning rounded-full"></div>
                                    <span class="text-xs text-warning">Proses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
      {{--ALERTS--}}
        @if(session('success') || session('error'))
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-300" 
    x-transition:enter-start="opacity-0 translate-y-2" 
    x-transition:enter-end="opacity-100 translate-y-0" 
    x-transition:leave="transition ease-in duration-200" 
    x-transition:leave-start="opacity-100 translate-y-0" 
    x-transition:leave-end="opacity-0 translate-y-2" 
    x-init="setTimeout(() => show = false, 4000)" 
    class="fixed top-5 right-5 z-50"
>
    <div class="flex items-center px-4 py-3 rounded-lg shadow-lg
        {{ session('success') ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700' }}">
        <div class="flex-shrink-0">
            @if(session('success'))
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            @else
                <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
            @endif
        </div>
        <div class="ml-3">
            <p class="font-semibold">
                {{ session('success') ? 'Berhasil!' : 'Terjadi Kesalahan!' }}
            </p>
            <p class="text-sm opacity-90">
                {{ session('success') ?? session('error') }}
            </p>
        </div>
        <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

    </div>

    <!-- Chart.js Configuration -->
    <script>
        // Population Trends Chart
        const populationCtx = document.getElementById('populationChart').getContext('2d');
        new Chart(populationCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: [2780, 2795, 2810, 2825, 2835, 2847],
                    borderColor: '#1565C0',
                    backgroundColor: 'rgba(21, 101, 192, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: '#F5F5F5'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Service Requests Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Surat Domisili', 'Surat Pindah', 'Surat Keterangan', 'Lainnya'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#1565C0', '#42A5F5', '#FF7043', '#4CAF50'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Real-time updates simulation
        setInterval(() => {
            const timestamp = new Date().toLocaleTimeString('id-ID');
            console.log(`Dashboard updated at ${timestamp}`);
        }, 30000);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.altKey) {
                switch(e.key) {
                    case '1':
                        window.location.href = 'resident_data_management.html';
                        break;
                    case '2':
                        window.location.href = 'family_card_management.html';
                        break;
                    case '3':
                        window.location.href = 'umkm_business_registry.html';
                        break;
                    case '4':
                        window.location.href = 'letter_request_processing.html';
                        break;
                }
            }
        });
    </script>

</body>
</html>