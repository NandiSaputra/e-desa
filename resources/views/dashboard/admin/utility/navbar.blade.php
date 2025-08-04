<!-- Fixed Navigation Header -->
<header class="bg-surface shadow-custom-sm border-b border-border-light fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Logo and Title -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <svg class="w-10 h-10 text-primary" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                    <path d="M12 7v5l4-2-4-3z" fill="white"/>
                </svg>
                <div>
                    <h1 class="text-xl font-heading font-semibold text-text-primary">
                        Digital Village {{ Auth::user()->role }}
                    </h1>
                    <p class="text-sm text-text-secondary">Dashboard Administratif</p>
                </div>
            </div>
        </div>
<!-- Profile Dropdown -->
<div x-data="{ open: false }" class="relative">
 <!-- Button -->
<button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
    <!-- Foto Profil -->
    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3"
         alt="Profile"
         class="w-10 h-10 rounded-full object-cover border-2 border-primary-100 shadow-sm"
         onerror="this.src='https://images.unsplash.com/photo-1584824486509-112e4181ff6b?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3'; this.onerror=null;" />

    <!-- Info User -->
    <div class="text-left leading-tight">
        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
        <p class="text-xs text-gray-500 truncate w-40">{{ Auth::user()->email }}</p>
        <p class="text-xs font-medium text-primary-600 capitalize">{{ Auth::user()->role }}</p>
    </div>

    <!-- Ikon Dropdown -->
    <i class="fas fa-chevron-down text-gray-500 text-xs ml-1"></i>
</button>


    <!-- Dropdown Menu -->
    <div x-cloak
         x-show="open"
         @click.away="open = false"
         x-transition
         class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 z-50 overflow-hidden">
        <a href="javascript:void(0)"
           @click="document.getElementById('editProfileModal').classList.remove('hidden'); open = false"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-user-edit mr-2"></i> Edit Profil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>

       
        </div>
    </div>
</header>
