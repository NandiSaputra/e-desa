<?php

namespace App\Http\Controllers;

use App\Imports\KartuKeluargaWargaImport;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelPdf\Facades\Pdf;

class KartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $query = KartuKeluarga::query();

    if ($search = $request->get('search')) {
        $query->where('no_kk', 'like', "%{$search}%")
              ->orWhere('kepala_keluarga', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%");
    }

    $kartuKeluargas = $query->paginate(10)->appends(['search' => $search]);

    return view('dashboard.admin.kartu_keluarga.index', compact('kartuKeluargas', 'search'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_kk' => 'required|string|min:16|max:16|unique:kartu_keluargas,no_kk',
            'kepala_keluarga' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);

        // Ubah semua value menjadi UPPERCASE
        $validated = array_map('strtoupper', $validated);

        // Simpan data
        KartuKeluarga::create($validated);

        return redirect()
            ->route('dashboard.admin.kartu_keluarga')
            ->with('success', 'Kartu Keluarga berhasil disimpan.');
    }

  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'no_kk' => 'required|string|min:16|max:16|unique:kartu_keluargas,no_kk,' . $id,
        'kepala_keluarga' => 'required|string|max:100',
        'alamat' => 'required|string|max:255',
        'rt' => 'required|string|max:5',
        'rw' => 'required|string|max:5',
        'desa' => 'required|string|max:100',
        'kecamatan' => 'required|string|max:100',
        'kabupaten' => 'required|string|max:100',
        'provinsi' => 'required|string|max:100',
    ]);

    $validated = array_map('strtoupper', $validated);

    $kartuKeluarga = KartuKeluarga::findOrFail($id);
    $kartuKeluarga->update($validated);

    $kartuKeluarga->save();

    return redirect()
        ->route('dashboard.admin.kartu_keluarga')
        ->with('success', 'Kartu Keluarga berhasil diperbarui.');
}
public function detail($id)
{
    $kartuKeluarga = KartuKeluarga::with(['anggotaKeluarga' => function($q) {
        $q->select('id','kartu_keluarga_id','nik','nama_lengkap','status_dalam_keluarga', 'tanggal_lahir');
    }])->find($id);

    if (!$kartuKeluarga) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    // Ubah key supaya jadi `warga`
    $data = $kartuKeluarga->toArray();
    $data['warga'] = $data['anggota_keluarga'];
    unset($data['anggota_keluarga']);

    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}


public function cetak($id)
{
    $kk = KartuKeluarga::with('anggotaKeluarga')->findOrFail($id);
    return Pdf::view('dashboard.admin.kartu_keluarga.cetak', compact('kk'))
        ->landscape()
        ->format('A4')
        ->name("KK_{$kk->no_kk}.pdf");
}
 public function form()
    {
        return view('import.kk');
    }

 public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,xlsx,xls'
    ]);

    Excel::import(new KartuKeluargaWargaImport, $request->file('file'));

    return redirect()
        ->route('dashboard.admin.kartu_keluarga')
        ->with('success', 'Data KK & Warga berhasil diimport!');
}

    public function destroy($id)
    {
        $kartuKeluarga = KartuKeluarga::findOrFail($id);
        $kartuKeluarga->delete();

        return redirect()
            ->route('dashboard.admin.kartu_keluarga')
            ->with('success', 'Kartu Keluarga berhasil dihapus.');
    }
}
