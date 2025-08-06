@extends('dashboard.layouts.dashboard')

@section('content')
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
@endsection
