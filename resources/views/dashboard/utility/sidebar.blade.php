<nav class="w-64 bg-surface shadow-custom-sm border-r border-border-light fixed left-0 top-20 bottom-0 overflow-y-auto">
    <div class="p-6">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard.admin') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->routeIs('dashboard.admin') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard.admin.kartu_keluarga') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->routeIs('dashboard.admin.kartu_keluarga*') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Kartu Keluarga</span>
                </a>
            </li>

            <li>
                <a href="resident_data_management.html"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->is('resident_data_management*') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-user-friends w-5"></i>
                    <span>Data Warga</span>
                </a>
            </li>

            <li>
                <a href="umkm_business_registry.html"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->is('umkm_business_registry*') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-store w-5"></i>
                    <span>UMKM</span>
                </a>
            </li>

            <li>
                <a href="news_content_management.html"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->is('news_content_management*') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Berita</span>
                </a>
            </li>

            <li>
                <a href="letter_request_processing.html"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium
                   {{ request()->is('letter_request_processing*') ? 'text-primary bg-primary-50' : 'text-text-secondary hover:text-primary hover:bg-primary-50 transition-colors' }}">
                    <i class="fas fa-file-alt w-5"></i>
                    <span>Surat Permohonan</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
