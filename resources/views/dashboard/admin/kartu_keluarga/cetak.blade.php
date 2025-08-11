<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Keluarga - {{ $kk->no_kk }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .kk-container {
            width: 100%;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header h4 {
            margin: 2px 0;
            font-size: 14px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 5px;
        }
        .info-table td {
            padding: 3px 5px;
            vertical-align: top;
        }
        table.data {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5px;
            table-layout: fixed;
        }
        table.data th, table.data td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
            font-size: 10px;
            word-wrap: break-word;
        }
        .footer {
            margin-top: 10px;
            width: 100%;
        }
        .footer td {
            font-size: 11px;
            text-align: center;
        }
        .sign {
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="kk-container">
        <!-- Header -->
        <div class="header">
            <h4>PEMERINTAH REPUBLIK INDONESIA</h4>
            <h2>KARTU KELUARGA</h2>
            <h4>No: {{ $kk->no_kk }}</h4>
        </div>

        <!-- Info Kepala Keluarga -->
        <table class="info-table">
            <tr>
                <td><strong>Kepala Keluarga</strong></td>
                <td>: {{ strtoupper($kk->kepala_keluarga) }}</td>
                <td><strong>Alamat</strong></td>
                <td>: {{ strtoupper($kk->alamat) }}</td>
            </tr>
            <tr>
                <td><strong>RT/RW</strong></td>
                <td>: {{ $kk->rt }}/{{ $kk->rw }}</td>
                <td><strong>Kode Pos</strong></td>
                <td>: {{ $kk->kode_pos ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Kelurahan/Desa</strong></td>
                <td>: {{ strtoupper($kk->desa) }}</td>
                <td><strong>Kecamatan</strong></td>
                <td>: {{ strtoupper($kk->kecamatan) }}</td>
            </tr>
            <tr>
                <td><strong>Kabupaten/Kota</strong></td>
                <td>: {{ strtoupper($kk->kabupaten) }}</td>
                <td><strong>Provinsi</strong></td>
                <td>: {{ strtoupper($kk->provinsi) }}</td>
            </tr>
        </table>

        <!-- Tabel 1: Data Pribadi -->
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 15%;">Nama Lengkap</th>
                    <th style="width: 13%;">NIK</th>
                    <th style="width: 8%;">Jenis Kelamin</th>
                    <th style="width: 10%;">Tempat Lahir</th>
                    <th style="width: 10%;">Tanggal Lahir</th>
                    <th style="width: 10%;">Agama</th>
                    <th style="width: 15%;">Pendidikan</th>
                    <th style="width: 16%;">Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kk->anggotaKeluarga as $i => $a)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ strtoupper($a->nama_lengkap) }}</td>
                    <td>{{ $a->nik }}</td>
                    <td>{{ strtoupper($a->jenis_kelamin) }}</td>
                    <td>{{ strtoupper($a->tempat_lahir) }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ strtoupper($a->agama) }}</td>
                    <td>{{ strtoupper($a->pendidikan) }}</td>
                    <td>{{ strtoupper($a->pekerjaan) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">Belum ada anggota keluarga</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tabel 2: Data Status & Orang Tua -->
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 15%;">Status Perkawinan</th>
                    <th style="width: 15%;">Status Hubungan</th>
                    <th style="width: 12%;">Kewarganegaraan</th>
                    <th style="width: 12%;">No Paspor</th>
                    <th style="width: 12%;">No KITAS/KITAP</th>
                    <th style="width: 15%;">Nama Ayah</th>
                    <th style="width: 16%;">Nama Ibu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kk->anggotaKeluarga as $i => $a)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ strtoupper($a->status_perkawinan) }}</td>
                    <td>{{ strtoupper($a->status_hubungan) }}</td>
                    <td>{{ strtoupper($a->kewarganegaraan) }}</td>
                    <td>{{ $a->no_paspor ?? '-' }}</td>
                    <td>{{ $a->no_kitas ?? '-' }}</td>
                    <td>{{ strtoupper($a->nama_ayah) }}</td>
                    <td>{{ strtoupper($a->nama_ibu) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">Belum ada anggota keluarga</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer tanda tangan -->
        <table class="footer">
            <tr>
                <td></td>
                <td>
                    {{ strtoupper($kk->kabupaten) }}, {{ now()->format('d-m-Y') }}<br>
                    Kepala Keluarga
                </td>
                <td>
                    Kepala Desa/Lurah<br>
                    {{ strtoupper($kk->desa) }}
                </td>
            </tr>
            <tr class="sign">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><strong>{{ strtoupper($kk->kepala_keluarga) }}</strong></td>
                <td><strong>____________________</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
