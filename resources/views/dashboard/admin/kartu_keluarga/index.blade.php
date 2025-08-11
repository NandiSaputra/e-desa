@extends('dashboard.layouts.dashboard')

@section('content')

  <!-- Page Header -->
  
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-heading font-semibold text-text-primary">Manajemen Kartu Keluarga</h2>
                    <p class="text-text-secondary mt-1">Kelola data kartu keluarga dan anggota keluarga</p>
                </div>
                <div  x-data="familyManager()" x-init="init()"class="flex items-center space-x-3">
                 <!-- Tombol Import -->
    <!-- Tombol Import CSV -->
<form action="{{ route('kartu_keluarga.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
    @csrf
    
    <!-- Input File Tersembunyi -->
    <input 
        type="file" 
        name="file" 
        id="importFile" 
        accept=".csv" 
        class="hidden" 
        required 
        onchange="this.form.submit()" 
    >

    <!-- Label Sebagai Tombol -->
    <label 
        for="importFile" 
        class="flex items-center space-x-2 px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary-500 transition-colors cursor-pointer"
    >
        <i class="fas fa-upload text-sm"></i>
        <span>Import CSV</span>
    </label>
</form>

    <!-- Tombol Tambah Keluarga -->
    <button @click="openCreateModal()" 
        class="flex items-center space-x-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus text-sm"></i>
        <span>Tambah Keluarga</span>
    </button>
    @include('dashboard.admin.kartu_keluarga.create_kk')
                </div>
            </div>

            <!-- Split Panel Layout -->
            <div x-data="familyManager()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-10 gap-6">
                <!-- Left Panel - Data Table (70%) -->
                <div class="lg:col-span-7">
                    <!-- Filter Toolbar -->
                    <div class="card mb-6">
                        <div class="flex flex-wrap items-center gap-4 mb-4">
                            
                            <!-- Search Input -->
                           <div class="flex-1 min-w-64">
   <div class="flex-1 min-w-64">
    <form method="GET" action="{{ route('dashboard.admin.kartu_keluarga') }}" class="flex items-center space-x-2">
        
        <!-- Input + Icon -->
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input 
                type="text" 
                id="searchInput" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari berdasarkan No. KK, Nama KK, atau Alamat..." 
                class="form-input pl-10 w-full"
                oninput="if(this.value.trim() === '') window.location='{{ route('dashboard.admin.kartu_keluarga') }}';" 
            />
        </div>

        <!-- Tombol -->
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700 flex items-center space-x-1"
        >
            <i class="fas fa-search"></i>
            <span>Cari</span>
        </button>
    </form>
</div>
</div>
                        </div>

                      
                    </div>

                    <!-- Data Table -->
                    <div class="card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full" id="familyTable">
                                <thead class="bg-gray-50 border-b border-border-light">
                                    <tr>
                                        <th class="px-4 py-3 text-left">
                                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="rounded border-border" />
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary cursor-pointer hover:text-primary" onclick="sortTable(1)">
                                            No. Kartu Keluarga
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary cursor-pointer hover:text-primary" onclick="sortTable(2)">
                                            Kepala Keluarga
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary cursor-pointer hover:text-primary" onclick="sortTable(3)">
                                            Alamat
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        {{-- <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary cursor-pointer hover:text-primary" onclick="sortTable(4)">
                                            Jumlah Anggota
                                            <i class="fas fa-sort ml-1"></i>
                                        </th> --}}
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary cursor-pointer hover:text-primary" onclick="sortTable(5)">
                                            Tanggal Daftar
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary">Status</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-text-secondary">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-light" id="familyTableBody">
                                 @foreach ($kartuKeluargas as $kartu_keluarga)
                                    <tr class="hover:bg-gray-50 transition-colors" data-family-id="3201234567890001">
                                        <td class="px-4 py-3">
                                            <input type="checkbox" class="row-checkbox rounded border-border" onchange="updateBulkActions()" />
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-data text-sm text-text-primary">{{ $kartu_keluarga->no_kk }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-3">
                                                
                                                <span class="font-medium text-text-primary">{{ $kartu_keluarga->kepala_keluarga }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-sm text-text-secondary">{{ $kartu_keluarga->alamat }}</span>
                                        </td>
                                                {{-- <td class="px-4 py-3">
                                                    <span class="text-sm text-text-primary">4 orang</span>
                                                </td> --}}
                                        <td class="px-4 py-3">
                                            <span class="text-sm text-text-secondary">{{ $kartu_keluarga->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge-success">{{ $kartu_keluarga->status }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div x-data="familyManager()" x-init="init()" class="flex items-center space-x-2">
                                                <button onclick="viewFamily('{{ $kartu_keluarga->id }}')" class="p-1 text-primary hover:bg-primary-50 rounded transition-colors" title="Lihat Detail">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </button>
                                         <button 
                                             @click="openEditModal({{ $kartu_keluarga }})"
                                                class="p-1 text-secondary hover:bg-secondary-50 rounded transition-colors" 
                                               title="Edit">
                                             <i class="fas fa-edit text-sm"></i>
                                            </button>
                                            @include('dashboard.admin.kartu_keluarga.edit_kk')
                                                <a href="{{route('dashboard.admin.kartu_keluarga.cetak', $kartu_keluarga->id)}}"   target="_blank" class="p-1 text-accent hover:bg-accent-50 rounded transition-colors" title="Cetak">
                                                    <i class="fas fa-print text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                 @endforeach   
                                 
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
           <div class="flex items-center justify-between px-6 py-4 border-t border-border-light">
    <div class="text-sm text-text-secondary">
        Menampilkan 
        <span class="font-medium">{{ $kartuKeluargas->firstItem() }}-{{ $kartuKeluargas->lastItem() }}</span>
        dari 
        <span class="font-medium">{{ $kartuKeluargas->total() }}</span> keluarga
    </div>

    <div class="flex items-center space-x-2">
        {{ $kartuKeluargas->links() }}
    </div>
</div>

                    </div>
                </div>

                <!-- Right Panel - Family Details (30%) -->
                <div class="lg:col-span-3">
                    <div class="card sticky top-6" id="familyDetailsPanel">
                        <div class="text-center py-12">
                            <i class="fas fa-users text-4xl text-text-secondary mb-4"></i>
                            <h3 class="text-lg font-medium text-text-primary mb-2">Pilih Keluarga</h3>
                            <p class="text-text-secondary text-sm">Klik pada baris tabel untuk melihat detail keluarga</p>
                        </div>
                    </div>
                </div>
            </di>
       


{{-- script ambil api data wilayah --}}
<script>

    //reset form Tambah Keluarga
   function resetKeluargaForm() {
    const form = document.querySelector('form[action="{{ route('kartu_keluarga.store') }}"]');
    if (form) {
        form.reset(); // reset semua input
    }
       // Hapus pesan error no_kk
    const errorEl = document.getElementById("no_kkError");
    if (errorEl) errorEl.remove();
}


//buat dan edit data keluarga
function familyManager(){
    return {
        showCreateModal: false,
        showEditModal: false,

        // Form data
        form: {
            id: null,
            no_kk: '',
            kepala_keluarga: '',
            alamat: '',
            rt: '',
            rw: '',
            provinsi: '',
            kabupaten: '',
            kecamatan: '',
            desa: '',
        },

        // Data wilayah
        provinces: {},
        regencies: {},
        districts: {},
        villages: {},

        // Selected names (for hidden inputs)
        provinsi: '',
        kabupaten: '',
        kecamatan: '',
        desa: '',
        provinsiNama: '',
        kabupatenNama: '',
        kecamatanNama: '',
        desaNama: '',

        init() {
            this.loadProvinces();
        },

        // Modal handler
        openCreateModal() {
            this.resetForm();
            this.showCreateModal = true;
        },
        closeCreateModal() {
            this.showCreateModal = false;
        },

         openEditModal(data) {
            if (typeof data === "string") {
        data = JSON.parse(decodeURIComponent(data));
    }
            this.showEditModal = true;
            this.form = {
                id: data.id,
                no_kk: data.no_kk,
                kepala_keluarga: data.kepala_keluarga,
                alamat: data.alamat,
                rt: data.rt,
                rw: data.rw,
                provinsi: data.provinsi,
                kabupaten: data.kabupaten,
                kecamatan: data.kecamatan,
                desa: data.desa,
            };
   

            this.loadRegencies();
            this.loadDistricts();
            this.loadVillages();
        },


        // Reset form
        resetForm() {
            this.form = {
                id: null,
                no_kk: '',
                kepala_keluarga: '',
                alamat: '',
                rt: '',
                rw: '',
                provinsi: '',
                kabupaten: '',
                kecamatan: '',
                desa: '',
            };
            this.provinsi = '';
            this.kabupaten = '';
            this.kecamatan = '';
            this.desa = '';
            this.provinsiNama = '';
            this.kabupatenNama = '';
            this.kecamatanNama = '';
            this.desaNama = '';
            this.provinces = {};
            this.regencies = {};
            this.districts = {};
            this.villages = {};
            this.loadProvinces();
        },

        // Load wilayah
        async loadProvinces() {
            let res = await fetch('/api/provinces');
            this.provinces = await res.json();
        },
        async loadRegencies() {
            this.regencies = {};
            if (this.provinsi) {
                let res = await fetch(`/api/regencies/${this.provinsi}`);
                this.regencies = await res.json();
            }
        },
        async loadDistricts() {
            this.districts = {};
            if (this.kabupaten) {
                let res = await fetch(`/api/districts/${this.provinsi}/${this.kabupaten}`);
                this.districts = await res.json();
            }
        },
        async loadVillages() {
            this.villages = {};
            if (this.kecamatan) {
                let res = await fetch(`/api/villages/${this.provinsi}/${this.kabupaten}/${this.kecamatan}`);
                this.villages = await res.json();
            }
        },

        // Nama updater
        updateProvinsiNama() {
            this.provinsiNama = this.provinces[this.provinsi] || '';
        },
        updateKabupatenNama() {
            this.kabupatenNama = this.regencies[this.kabupaten] || '';
        },
        updateKecamatanNama() {
            this.kecamatanNama = this.districts[this.kecamatan] || '';
        },
        updateDesaNama() {
            this.desaNama = this.villages[this.desa] || '';
        },
    }
}
async function viewFamily(id) {
    const panel = document.getElementById('familyDetailsPanel');
    panel.innerHTML = `<div class="py-12 text-center text-sm text-text-secondary">Memuat data keluarga...</div>`;

    try {
        const res = await fetch(`/kartu-keluarga/${id}/detail`);
        if (!res.ok) throw new Error('Gagal memuat data');

        const result = await res.json();

        if (!result.success) throw new Error(result.message);

        const data = result.data;

        panel.innerHTML = `
            <!-- Header -->
            <div class="border-b border-border-light pb-4 mb-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-heading font-semibold text-text-primary">Detail Keluarga</h3>
                    <button onclick="editFamily('${data.no_kk}')" class="text-primary hover:text-primary-600">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            </div>

            <!-- Info Utama (2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-text-secondary">No. Kartu Keluarga</label>
                        <p class="font-data text-text-primary">${data.no_kk}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-text-secondary">Kepala Keluarga</label>
                        <p class="text-text-primary font-medium">${data.kepala_keluarga}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-text-secondary">Status</label>
                        <span class="badge-success">${data.status}</span>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-text-secondary">Tanggal Daftar</label>
                        <p class="text-text-primary">${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div><label class="text-sm font-medium text-text-secondary">Provinsi</label><p class="text-text-primary">${data.provinsi ?? '-'}</p></div>
                    <div><label class="text-sm font-medium text-text-secondary">Kabupaten/Kota</label><p class="text-text-primary">${data.kabupaten ?? '-'}</p></div>
                    <div><label class="text-sm font-medium text-text-secondary">Kecamatan</label><p class="text-text-primary">${data.kecamatan ?? '-'}</p></div>
                    <div><label class="text-sm font-medium text-text-secondary">Desa/Kelurahan</label><p class="text-text-primary">${data.desa ?? '-'}</p></div>
                    <div><label class="text-sm font-medium text-text-secondary">Alamat Lengkap</label><p class="text-text-primary">${data.alamat}</p></div>
                </div>
            </div>

         <!-- Anggota Keluarga -->
<div class="border-t border-border-light pt-4 mt-6">
    <h4 class="font-medium text-text-primary mb-3">
        Anggota Keluarga (${data.warga ? data.warga.length : 0})
    </h4>
    <div class="space-y-3">
        ${
            data.warga && data.warga.length > 0
            ? urutkanWarga(data.warga).map(w => `
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-text-primary">${w.nama_lengkap}</p>
                        <p class="text-sm text-text-secondary">
                            ${w.status_dalam_keluarga} • ${hitungUmur(w.tanggal_lahir)} tahun
                        </p>
                        <p class="text-sm text-text-secondary">${w.nik}</p>
                    </div>
                    <button class="text-primary hover:text-primary-600">
                        <i class="fas fa-eye text-sm"></i>
                    </button>
                </div>
            `).join('')
            : `<p class="text-sm text-text-secondary">Data anggota belum tersedia</p>`
        }
    </div>
</div>

<!-- Tombol Aksi -->
<div class="border-t border-border-light pt-4 mt-6">
    <div class="flex space-x-2">
        <button onclick="printFamily('${data.no_kk}')" class="flex-1 btn-primary">
            <i class="fas fa-print mr-2"></i> Cetak KK
        </button>
        <button onclick="editFamily('${data.no_kk}')" class="flex-1 btn-secondary">
            <i class="fas fa-edit mr-2"></i> Edit
        </button>
    </div>
</div>

        `;
    } catch (error) {
        console.error(error);
        panel.innerHTML = `<div class="text-red-500 text-center py-8">Gagal memuat detail keluarga. ${error.message ?? ''}</div>`;
    }
}

function urutkanWarga(warga) {
    const urutanStatus = [
        'KEPALA KELUARGA', 'SUAMI', 'ISTRI',
        'ANAK', 'MENANTU', 'CUCU',
        'ORANG_TUA', 'MERTUA', 'FAMILI_LAIN',
        'PEMBANTU', 'LAINNYA'
    ];

    return warga.sort((a, b) => {
        const indexA = urutanStatus.indexOf(a.status_dalam_keluarga.toUpperCase());
        const indexB = urutanStatus.indexOf(b.status_dalam_keluarga.toUpperCase());
        
        // Jika status sama, urutkan berdasarkan tanggal lahir (yang tua dulu)
        if (indexA === indexB) {
            return new Date(a.tanggal_lahir) - new Date(b.tanggal_lahir);
        }

        return indexA - indexB;
    });
}
function hitungUmur(tanggalLahir) {
    const tgl = new Date(tanggalLahir);
    const today = new Date();

    let umur = today.getFullYear() - tgl.getFullYear();
    const m = today.getMonth() - tgl.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < tgl.getDate())) {
        umur--;
    }

    return umur;
}
document.addEventListener("DOMContentLoaded", () => {
    const noKkInput = document.querySelector('input[name="no_kk"]');
    const families = @json($kartuKeluargas->pluck('no_kk')); // ambil semua no_kk dari Laravel

    noKkInput.addEventListener("input", () => {
        const value = noKkInput.value.trim();
        removeError();

        // Cek panjang
        if (value.length < 16) {
            showError("Nomor Kartu Keluarga harus 16 karakter");
            return;
        }

        if (value.length > 16) {
            showError("Nomor Kartu Keluarga tidak boleh lebih dari 16 karakter");
            return;
        }

        // Cek apakah sudah ada di database
        if (families.includes(value)) {
            showError("Nomor Kartu Keluarga sudah terdaftar");
            return;
        }
    });

    function showError(message) {
        removeError();
        const errorEl = document.createElement("p");
        errorEl.id = "no_kkError";
        errorEl.className = "text-red-500 text-sm flex items-center mt-1";
        errorEl.innerHTML = `<i class="fas fa-exclamation-circle mr-1"></i> ${message}`;
        
        // Jika input dibungkus .relative, taruh di luar .relative, kalau tidak taruh langsung di bawah input
        if (noKkInput.closest(".relative")) {
            noKkInput.closest(".relative").insertAdjacentElement("afterend", errorEl);
        } else {
            noKkInput.insertAdjacentElement("afterend", errorEl);
        }
    }

    function removeError() {
        const existingError = document.getElementById("no_kkError");
        if (existingError) existingError.remove();
    }
});
//FUNCTION SEARCH
function kkSearch() {
    return {
        searchQuery: '',
        searchFamilies() {
            fetch(`{{ route('dashboard.admin.kartu_keluarga') }}?search=${encodeURIComponent(this.searchQuery)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                document.querySelector('#familyTable').innerHTML = html;
            });
        }
    }
}
</script>
@endsection