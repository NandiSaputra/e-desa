<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    User::updateOrCreate([
        'name' => 'Admin Desa',
        'email' => 'admin@desa.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);

    User::updateOrCreate([
        'name' => 'Perangkat Desa',
        'email' => 'perangkat@desa.com',
        'password' => Hash::make('password'),
        'role' => 'perangkat'
    ]);

    User::updateOrCreate([
        'name' => 'Warga Desa',
        'email' => 'warga@desa.com',
        'password' => Hash::make('password'),
        'role' => 'warga'
    ]);
}
}
