<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus kode yang ada di dalam sini, ganti dengan ini:

        Lapangan::create([
            'nama_lapangan' => 'Lapangan A (Sintetis)',
            'jenis' => 'Futsal',
            'harga_per_jam' => 150000,
            'gambar_url' => 'https://images.unsplash.com/photo-1551954228-475a50e5033c?fit=crop&w=400',
            'lokasi' => 'Jakarta Selatan',
            'rating' => 4.85
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan B (Matras)',
            'jenis' => 'Badminton',
            'harga_per_jam' => 120000,
            'gambar_url' => 'https://images.unsplash.com/photo-1594499468121-f45e83f2b604?fit=crop&w=400',
            'lokasi' => 'Kota Bandung',
            'rating' => 4.70
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan Voli C',
            'jenis' => 'Voli',
            'harga_per_jam' => 100000,
            'gambar_url' => 'https://images.unsplash.com/photo-1542506825-f3ce12f385f8?fit=crop&w=400',
            'lokasi' => 'Surabaya',
            'rating' => 4.90
        ]);
    }
}