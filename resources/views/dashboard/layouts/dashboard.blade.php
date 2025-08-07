<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
  
     <meta name="csrf-token" content="{{ csrf_token() }}">
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
  
@include('dashboard.utility.navbar')
    <!-- Main Layout -->
    <div class="flex pt-20">
        <!-- Sidebar Navigation -->
     @include('dashboard.utility.sidebar')
        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-6">
            @yield('content')
            
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
{{-- 
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
    </script> --}}

</body>
</html>