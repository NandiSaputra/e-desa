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
    <button onclick="openImportModal()" 
        class="flex items-center space-x-2 px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary-500 transition-colors">
        <i class="fas fa-upload text-sm"></i>
        <span>Import CSV</span>
    </button>

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
            <div  x-data="familyManager()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-10 gap-6">
                <!-- Left Panel - Data Table (70%) -->
                <div class="lg:col-span-7">
                    <!-- Filter Toolbar -->
                    <div class="card mb-6">
                        <div class="flex flex-wrap items-center gap-4 mb-4">
                            <!-- Search Input -->
                            <div class="flex-1 min-w-64">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-text-secondary"></i>
                                    <input type="text" id="searchInput" placeholder="Cari berdasarkan No. KK, Nama KK, atau Alamat..." class="form-input pl-10" onkeyup="filterTable()" />
                                </div>
                            </div>

                            <!-- Address Filter -->
                            <select id="addressFilter" class="form-input w-48" onchange="filterTable()">
                                <option value>Semua Alamat</option>
                                <option value="RT 01">RT 01</option>
                                <option value="RT 02">RT 02</option>
                                <option value="RT 03">RT 03</option>
                                <option value="RT 04">RT 04</option>
                                <option value="RT 05">RT 05</option>
                            </select>

                            <!-- Status Filter -->
                            <select id="statusFilter" class="form-input w-40" onchange="filterTable()">
                                <option value>Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                                <option value="Pindah">Pindah</option>
                            </select>

                            <!-- Filter Reset -->
                            <button onclick="resetFilters()" class="px-4 py-2 text-text-secondary hover:text-primary border border-border rounded-lg transition-colors">
                                <i class="fas fa-undo text-sm mr-2"></i>
                                Reset
                            </button>
                        </div>

                        <!-- Bulk Actions -->
                        <div id="bulkActions" class="flex items-center justify-between p-3 bg-primary-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-medium text-primary">
                                    <span id="selectedCount">0</span> keluarga dipilih
                                </span>
                                <button onclick="bulkStatusUpdate()" class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-primary-600 transition-colors">
                                    Update Status
                                </button>
                                <button onclick="bulkExport()" class="px-3 py-1 bg-secondary text-white text-sm rounded hover:bg-secondary-500 transition-colors">
                                    Export
                                </button>
                                <button onclick="bulkDelete()" class="px-3 py-1 bg-error text-white text-sm rounded hover:bg-error-600 transition-colors">
                                    Hapus
                                </button>
                            </div>
                            <button onclick="clearSelection()" class="text-text-secondary hover:text-primary">
                                <i class="fas fa-times"></i>
                            </button>
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
                                                <button onclick="printFamily('3201234567890001')" class="p-1 text-accent hover:bg-accent-50 rounded transition-colors" title="Cetak">
                                                    <i class="fas fa-print text-sm"></i>
                                                </button>
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
            </div>
       

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



// // ambil detail keluarga
// const families = @json($kartuKeluargas->items());

// window.viewFamily = function(familyNoKK) {
//     const family = families.find(f => f.no_kk === familyNoKK);
//     if (!family) {
//         console.error("Data keluarga tidak ditemukan");
//         return;
//     }

//     const detailsPanel = document.getElementById('familyDetailsPanel');
//     detailsPanel.innerHTML = `
//         <!-- Header -->
//         <div class="border-b border-border-light pb-4 mb-4">
//             <div class="flex items-center justify-between">
//                 <h3 class="text-lg font-heading font-semibold text-text-primary">Detail Keluarga</h3>
//                 <button onclick="editFamily('${family.no_kk}')" class="text-primary hover:text-primary-600">
//                     <i class="fas fa-edit"></i>
//                 </button>
//             </div>
//         </div>

//         <!-- Info Utama (2 Kolom) -->
//         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
//             <!-- Kolom Kiri -->
//             <div class="space-y-4">
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">No. Kartu Keluarga</label>
//                     <p class="font-data text-text-primary">${family.no_kk}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Kepala Keluarga</label>
//                     <p class="text-text-primary font-medium">${family.kepala_keluarga}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Status</label>
//                     <span class="badge-success">${family.status}</span>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Tanggal Daftar</label>
//                     <p class="text-text-primary">${new Date(family.created_at).toLocaleDateString('id-ID')}</p>
//                 </div>
//             </div>

//             <!-- Kolom Kanan -->
//             <div class="space-y-3">
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Provinsi</label>
//                     <p class="text-text-primary">${family.provinsi ?? '-'}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Kabupaten/Kota</label>
//                     <p class="text-text-primary">${family.kabupaten ?? '-'}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Kecamatan</label>
//                     <p class="text-text-primary">${family.kecamatan ?? '-'}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Desa/Kelurahan</label>
//                     <p class="text-text-primary">${family.desa ?? '-'}</p>
//                 </div>
//                 <div>
//                     <label class="text-sm font-medium text-text-secondary">Alamat Lengkap</label>
//                     <p class="text-text-primary">${family.alamat}</p>
//                 </div>
//             </div>
//         </div>

//         <!-- Anggota Keluarga -->
//         <div class="border-t border-border-light pt-4 mt-6">
//             <h4 class="font-medium text-text-primary mb-3">Anggota Keluarga</h4>
//             <p class="text-sm text-text-secondary">Data anggota belum tersedia</p>
//         </div>

//         <!-- Tombol Aksi -->
//         <div class="border-t border-border-light pt-4 mt-6">
//             <div class="flex space-x-2">
//                 <button onclick="printFamily('${family.no_kk}')" class="flex-1 btn-primary">
//                     <i class="fas fa-print mr-2"></i>
//                     Cetak KK
//                 </button>
//                 <button onclick="editFamily('${family.no_kk}')" class="flex-1 btn-secondary">
//                     <i class="fas fa-edit mr-2"></i>
//                     Edit
//                 </button>
//             </div>
//         </div>
//     `;
// };

async function viewFamily(id) {
    const panel = document.getElementById('familyDetailsPanel');
    panel.innerHTML = `<div class="py-12 text-center text-sm text-text-secondary">Memuat data keluarga...</div>`;

    try {
        const res = await fetch(`/kartu-keluarga/${id}/detail`);
        if (!res.ok) throw new Error('Gagal memuat data');

        const result = await res.json();

        if (!result.success) throw new Error(result.message || 'Gagal memuat data');

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
                <h4 class="font-medium text-text-primary mb-3">Anggota Keluarga</h4>
                ${data.warga && data.warga.length > 0 ? `
                    <ul class="list-disc pl-5 text-sm text-text-primary space-y-1">
                        ${data.warga.map(w => `<li>${w.nama} (${w.nik})</li>`).join('')}
                    </ul>
                ` : `<p class="text-sm text-text-secondary">Data anggota belum tersedia</p>`}
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


</script>
@endsection