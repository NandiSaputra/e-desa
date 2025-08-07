{{--modal edit --}}
<div 
    x-show="showEditModal"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
    @click.self="showEditModal = false"
    style="display: none;" {{-- Supaya tidak muncul sebelum Alpine aktif --}}
>
 <div
    @click.outside="showCreateModal = false"
    class="bg-white p-6 rounded shadow-lg w-full max-w-2xl"
  >

    <div class="bg-surface rounded-lg shadow-custom-lg w-full max-w-2xl max-h-screen overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-border-light">
            <h3 class="text-lg font-heading font-semibold text-text-primary">Edit Kartu Keluarga</h3>
            <button @click="showEditModal = false" class="text-text-secondary hover:text-primary">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
      
      <form :action="`{{ url('kartu-keluarga') }}/${form.id}`" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            <!-- Form Fields -->
              <input type="hidden" name="id" :value="form.id">
            <div class=" relative grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Nomor Kartu Keluarga</label>
                    <input type="text" name="no_kk"  x-model="form.no_kk" id="no_kk" class="form-input" placeholder="Nomor Kartu Keluarga" required />
                </div>
                @error('no_kk')
        <p id="no_kkError" class="text-red-500 text-sm flex items-center mt-1">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
        </p>
    @enderror
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Nama Kepala Keluarga</label>
                    <input type="text" name="kepala_keluarga"  x-model="form.kepala_keluarga" class="form-input" placeholder="Nama Kepala Keluarga" required />
                </div>
            </div>
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Provinsi</label>
             <!-- Provinsi -->
<select x-model="provinsi" 
        @change="updateProvinsiNama(); loadRegencies()" 
        name="provinsi_kode" 
        class="form-input" required>
    <option value="">Pilih Provinsi</option>
    <template x-for="(nama, kode) in provinces" :key="kode">
        <option :value="kode" x-text="nama"></option>
    </template>
</select>
<input type="hidden" name="provinsi" :value="provinsiNama">
                </div>
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Kota/Kabupaten</label>
                <select x-model="kabupaten" 
        @change="updateKabupatenNama(); loadDistricts()" 
        name="kabupaten_kode" 
        class="form-input" required>
    <option value="">Pilih Kabupaten</option>
    <template x-for="(nama, kode) in regencies" :key="kode">
        <option :value="kode" x-text="nama"></option>
    </template>
</select>
<input type="hidden" name="kabupaten" :value="kabupatenNama">
                </div>
                
            </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Kecamatan</label>
              <select x-model="kecamatan" 
        @change="updateKecamatanNama(); loadVillages()" 
        name="kecamatan_kode" 
        class="form-input" required>
    <option value="">Pilih Kecamatan</option>
    <template x-for="(nama, kode) in districts" :key="kode">
        <option :value="kode" x-text="nama"></option>
    </template>
</select>
<input type="hidden" name="kecamatan" :value="kecamatanNama">
                </div>
                  <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">Desa</label>
             <select x-model="desa" 
        @change="updateDesaNama()" 
        name="desa_kode" 
        class="form-input" required>
    <option value="">Pilih Desa</option>
    <template x-for="(nama, kode) in villages" :key="kode">
        <option :value="kode" x-text="nama"></option>
    </template>
</select>
<input type="hidden" name="desa" :value="desaNama">
                </div>
            </div>
            
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">RT</label>
                    <input type="text" name="rt" x-model="form.rt" class="form-input" placeholder="RT" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">RW</label>
                    <input type="text" name="rw" x-model="form.rw" class="form-input" placeholder="RW" required />

                </div>
             
            </div>
            <div> 
                <label class="block text-sm font-medium text-text-primary mb-2">Alamat Lengkap</label>
                <textarea class="form-input h-24" name="alamat" x-model="form.alamat" placeholder="Alamat Lengkap" required></textarea>
            </div>
             
        

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-border-light">
                <button type="button"  onclick="resetKeluargaForm()" @click="showEditModal = false" class="px-6 py-2 border border-border text-text-secondary rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="btn-primary">
                    Simpan Keluarga
                </button>
            </div>
        </form>
    </div>
</div>
</div>

