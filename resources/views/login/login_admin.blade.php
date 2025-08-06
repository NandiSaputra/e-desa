<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistem Informasi Desa</title>
   @vite(['resources/css/app.css', 'resources/css/loginadmin.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fvillagema9724back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.6"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-50 to-secondary-50">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side - Background Illustration (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)"/>
                </svg>
            </div>
            
            <!-- Village Illustration -->
            <div class="relative z-10 flex flex-col justify-center items-center p-12 text-white">
                <div class="max-w-md text-center">
                    <!-- Village Scene Illustration -->
                    <div class="mb-8">
                        <img src="https://images.pexels.com/photos/1402787/pexels-photo-1402787.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Indonesian Village Scene" class="w-80 h-64 object-cover rounded-2xl shadow-elevation" onerror="this.src='https://images.unsplash.com/photo-1584824486509-112e4181ff6b?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; this.onerror=null;" />
                    </div>
                    
                    <!-- Welcome Text -->
                    <h1 class="text-3xl font-bold mb-4">Selamat Datang</h1>
                    <p class="text-lg opacity-90 leading-relaxed">
                        Sistem informasi terintegrasi untuk pengelolaan administrasi desa yang efisien dan transparan
                    </p>
                    
                    <!-- Village Elements Icons -->
                    <div class="flex justify-center space-x-6 mt-8">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-seedling text-xl"></i>
                            </div>
                            <span class="text-sm opacity-80">Pertanian</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <span class="text-sm opacity-80">Masyarakat</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-building text-xl"></i>
                            </div>
                            <span class="text-sm opacity-80">Pemerintahan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="flex-1 lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md">
                <!-- Logo Section -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-2xl mb-4 shadow-gentle">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                            <path d="M12 7L8 10v4h8v-4l-4-3z" fill="white" opacity="0.7"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-text-primary mb-2">Sistem Informasi Desa</h2>
                    <p class="text-text-secondary">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.process') }}" id="loginForm" class="space-y-6">
                    @csrf

                    <!-- Role Selection Toggle -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-text-primary mb-3">Pilih Peran</label>
                        <div class="relative bg-gray-100 rounded-xl p-1 flex">
                            <button type="button" id="adminRole" class="flex-1 py-3 px-4 text-sm font-medium rounded-lg transition-all duration-200 bg-primary text-white shadow-subtle">
                                <i class="fas fa-user-shield mr-2"></i>
                                Admin
                            </button>
                            <button type="button" id="perangkatRole" class="flex-1 py-3 px-4 text-sm font-medium rounded-lg transition-all duration-200 text-text-secondary hover:text-text-primary">
                                <i class="fas fa-user-tie mr-2"></i>
                                Perangkat Desa
                            </button>
                        </div>
                    </div>
                    <!-- Hidden Role Input -->
                    <input type="hidden" id="role" name="role" value="admin">

                    <!-- Email/Username Input -->
               <div class="space-y-2">
    <label for="email" class="block text-sm font-medium text-text-primary">
        Email atau Username
    </label>

    <div class="relative">
        <!-- Ikon Email -->
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-text-secondary"></i>
        </div>

        <!-- Input -->
        <input type="text" id="email" name="email"
            value="{{ old('email') }}"
            required
            class="input-field pl-12 pr-4 py-3 w-full"
            placeholder="Masukkan email atau username" />
    </div>

    <!-- Error di sini, di luar .relative -->
    @error('email')
        <p id="error-email" class="text-red-500 text-sm flex items-center mt-1">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
        </p>
    @enderror
</div>


                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-text-primary">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-text-secondary"></i>
                            </div>
                            <input type="password" id="password" name="password" required class="input-field pl-12 pr-12 py-3 w-full" placeholder="Masukkan kata sandi" />
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <i class="fas fa-eye text-text-secondary hover:text-text-primary transition-colors duration-200"></i>
                            </button>
                        </div>
                        <div>            @error('password')
        <p id="passwordError" class="text-red-500 text-sm flex items-center mt-1">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
        </p>
    @enderror</div>
               
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" id="remember" class="w-4 h-4 text-primary bg-surface border-gray-300 rounded focus:ring-primary-300 focus:ring-2" />
                            <span class="ml-2 text-sm text-text-secondary">Ingat saya</span>
                        </label>
                        <a href="javascript:void(0)" class="text-sm text-primary hover:text-primary-700 transition-colors duration-200">
                            Lupa kata sandi?
                        </a>
                    </div>
                    <!-- Login Error Message -->
                    {{-- Alert Sukses --}}
@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        x-init="setTimeout(() => show = false, 3000)" {{-- hilang setelah 3 detik --}}
        class="mt-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 flex items-center space-x-2"
    >
        <i class="fas fa-check-circle text-green-500"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{-- Alert Error --}}
@if (session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        x-init="setTimeout(() => show = false, 3000)" {{-- hilang setelah 3 detik --}}
        class="mt-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 flex items-center space-x-2"
    >
        <i class="fas fa-exclamation-circle text-red-500"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

                    <!-- Login Button -->
                    <button type="submit" id="loginButton" class="w-full btn-primary py-4 text-base font-semibold rounded-xl shadow-gentle hover:shadow-elevation transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk ke Sistem
                    </button>

       

                </form>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-text-secondary">
                        © 2025 Sistem Informasi Desa. Semua hak dilindungi.
                    </p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <a href="javascript:void(0)" class="text-xs text-text-secondary hover:text-primary transition-colors duration-200">
                            Bantuan
                        </a>
                        <span class="text-xs text-text-secondary">•</span>
                        <a href="javascript:void(0)" class="text-xs text-text-secondary hover:text-primary transition-colors duration-200">
                            Kebijakan Privasi
                        </a>
                        <span class="text-xs text-text-secondary">•</span>
                        <a href="javascript:void(0)" class="text-xs text-text-secondary hover:text-primary transition-colors duration-200">
                            Syarat Layanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>

    //toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const adminRoleButton = document.getElementById('adminRole');
        const perangkatRoleButton = document.getElementById('perangkatRole');
        const roleInput = document.getElementById('role');

        adminRoleButton.addEventListener('click', function() {
            roleInput.value = 'admin';
            adminRoleButton.classList.add('bg-primary', 'text-white', 'shadow-subtle');
            perangkatRoleButton.classList.remove('bg-primary', 'text-white', 'shadow-subtle');
        });

        perangkatRoleButton.addEventListener('click', function() {
            roleInput.value = 'perangkat';
            perangkatRoleButton.classList.add('bg-primary', 'text-white', 'shadow-subtle');
            adminRoleButton.classList.remove('bg-primary', 'text-white', 'shadow-subtle');
        });
    });
    //hapus error email tidak valid 
   
document.addEventListener("DOMContentLoaded", function () {
    // Cari semua input
    document.querySelectorAll("input").forEach(function (input) {
        input.addEventListener("input", function () {
            let errorEl = document.querySelector(`#error-${input.name}`);
            if (errorEl) {
                errorEl.remove(); // hapus elemen error
            }
        });
    });
});
    //hapus error pasword tidak valid
document.addEventListener("DOMContentLoaded", function () {
    // Cari semua input
    document.querySelectorAll("input").forEach(function (input) {
        input.addEventListener("input", function () {
            let errorEl = document.querySelector(`#${input.name}Error`);
            if (errorEl) {
                errorEl.remove(); // hapus elemen error
            }
        });
    });
});

//alert jika email bukan email dan password kurang dari 6 karakter
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function (event) {
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        let hasError = false;

    // Untuk Email
if (!emailInput.value.includes("@")) {
    hasError = true;
    if (!document.getElementById("error-email")) {
        const errorEl = document.createElement("p");
        errorEl.id = "error-email";
        errorEl.className = "text-red-500 text-sm flex items-center mt-1";
        errorEl.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> Email tidak valid';
        // Masukkan setelah div.relative
        emailInput.closest(".relative").insertAdjacentElement("afterend", errorEl);
    }
}

// Untuk Password
if (passwordInput.value.length < 6) {
    hasError = true;
    if (!document.getElementById("passwordError")) {
        const errorEl = document.createElement("p");
        errorEl.id = "passwordError";
        errorEl.className = "text-red-500 text-sm flex items-center mt-1";
        errorEl.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> Kata sandi harus minimal 6 karakter';
        passwordInput.closest(".relative").insertAdjacentElement("afterend", errorEl);
    }
}


        if (hasError) {
            event.preventDefault(); // Batalkan submit jika ada error
        }
    });
});

</script>
</body>
</html>