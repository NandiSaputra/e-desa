<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
       public function getProvinces()
    {
        $response = Http::get('https://sipedas.pertanian.go.id/api/wilayah/list_pro', [
            'thn' => 2025
        ]);
        return $response->json();
    }

    public function getRegencies($provCode)
    {
        $response = Http::get('https://sipedas.pertanian.go.id/api/wilayah/list_kab', [
            'thn' => 2025,
            'pro' => $provCode,
            'lvl' => 11
        ]);
        return $response->json();
    }

    public function getDistricts($provCode, $kabCode)
    {
        $response = Http::get('https://sipedas.pertanian.go.id/api/wilayah/list_kec', [
            'thn' => 2025,
            'pro' => $provCode,
            'kab' => $kabCode,
            'lvl' => 12
        ]);
        return $response->json();
    }

    public function getVillages($provCode, $kabCode, $kecCode)
    {
        $response = Http::get('https://sipedas.pertanian.go.id/api/wilayah/list_des', [
            'thn' => 2025,
            'pro' => $provCode,
            'kab' => $kabCode,
            'kec' => $kecCode,
            'lvl' => 13,
            'lv2' => 14
        ]);
        return $response->json();
    }
}
