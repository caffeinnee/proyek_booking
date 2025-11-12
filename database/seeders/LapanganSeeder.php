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
            'nama_lapangan' => 'Lapangan A',
            'jenis' => 'Sintetis',
            'harga_per_jam' => 150000
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Lapangan B',
            'jenis' => 'Matras',
            'harga_per_jam' => 120000
        ]);
    }
}