<?php

namespace App\Imports;

use App\Models\KartuKeluarga;
use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class KartuKeluargaWargaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Sanitasi dan uppercase teks
            $no_kk = trim($row['no_kk'] ?? '');
            $nik = trim($row['nik'] ?? '');

            // Buat atau ambil KK
            $kk = KartuKeluarga::firstOrCreate(
                ['no_kk' => $no_kk],
                [
                    'kepala_keluarga' => strtoupper(trim($row['kepala_keluarga'] ?? '')),
                    'alamat'          => strtoupper(trim($row['alamat'] ?? '')),
                    'rt'              => trim($row['rt'] ?? ''),
                    'rw'              => trim($row['rw'] ?? ''),
                    'desa'            => strtoupper(trim($row['desa'] ?? '')),
                    'kecamatan'       => strtoupper(trim($row['kecamatan'] ?? '')),
                    'kabupaten'       => strtoupper(trim($row['kabupaten'] ?? '')),
                    'provinsi'        => strtoupper(trim($row['provinsi'] ?? '')),
                ]
            );

            // Format tanggal lahir aman
            $tanggal_lahir = null;
            if (!empty($row['tanggal_lahir'])) {
                try {
                    $tanggal_lahir = Carbon::createFromFormat('d-m-Y', trim($row['tanggal_lahir']))->format('Y-m-d');
                } catch (\Exception $e) {
                    // Jika format tidak sesuai, biarkan null atau log error
                    $tanggal_lahir = null;
                }
            }

            // Validasi status_dalam_keluarga sesuai enum
            $allowedStatus = [
                'KEPALA KELUARGA', 'SUAMI', 'ISTRI', 'ANAK', 'MENANTU', 'CUCU',
                'ORANG TUA', 'MERTUA', 'FAMILI LAIN', 'PEMBANTU', 'LAINNYA'
            ];
            $status_keluarga = strtoupper(trim($row['status_dalam_keluarga'] ?? 'LAINNYA'));
            if (!in_array($status_keluarga, $allowedStatus)) {
                $status_keluarga = 'LAINNYA';
            }

            // Simpan data Warga
            Warga::updateOrCreate(
                ['nik' => $nik],
                [
                    'kartu_keluarga_id' => $kk->id,
                    'nama_lengkap'      => strtoupper(trim($row['nama_lengkap'] ?? '')),
                    'jenis_kelamin'     => strtoupper(trim($row['jenis_kelamin'] ?? '')),
                    'tempat_lahir'      => strtoupper(trim($row['tempat_lahir'] ?? '')),
                    'tanggal_lahir'     => $tanggal_lahir,
                    'agama'             => strtoupper(trim($row['agama'] ?? '')),
                    'pendidikan'        => strtoupper(trim($row['pendidikan'] ?? '')),
                    'pekerjaan'         => strtoupper(trim($row['pekerjaan'] ?? '')),
                    'status_perkawinan' => strtoupper(trim($row['status_perkawinan'] ?? '')),
                    'status_dalam_keluarga' => $status_keluarga,
                    'kewarganegaraan'   => strtoupper(trim($row['kewarganegaraan'] ?? '')),
                    'no_paspor'         => !empty($row['no_paspor']) ? strtoupper(trim($row['no_paspor'])) : null,
                    'no_kitas'          => !empty($row['no_kitas']) ? strtoupper(trim($row['no_kitas'])) : null,
                    'nama_ayah'         => strtoupper(trim($row['nama_ayah'] ?? '')),
                    'nama_ibu'          => strtoupper(trim($row['nama_ibu'] ?? '')),
                ]
            );
        }
    }
}
