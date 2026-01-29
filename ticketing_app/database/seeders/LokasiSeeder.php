<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $lokasi = [
            ['nama_lokasi' => 'Stadion Utama', 'aktif' => 'Y'],
            ['nama_lokasi' => 'Galeri Seni Kota', 'aktif' => 'Y'],
            ['nama_lokasi' => 'Taman Kota', 'aktif' => 'Y'],
            ['nama_lokasi' => 'Medan', 'aktif' => 'N'],
        ];

        foreach ($lokasi as $item) {
            Lokasi::create($item);
        }
    }
}