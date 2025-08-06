<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        $kartuKeluargas = KartuKeluarga::orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.admin.kartu_keluarga.index', compact('kartuKeluargas'));
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
}
