<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'kode_barang' => 'ELC-001',
                'nama_barang' => 'MacBook Pro M2 14-inch',
                'kategori_id' => 1,
                'stok'        => 12,
            ],
            [
                'kode_barang' => 'ELC-002',
                'nama_barang' => 'Logitech MX Master 3S',
                'kategori_id' => 1,
                'stok'        => 5,
            ],

            [
                'kode_barang' => 'ATK-001',
                'nama_barang' => 'Kertas A4 80gr (Rim)',
                'kategori_id' => 2,
                'stok'        => 50,
            ],

            [
                'kode_barang' => 'PRB-001',
                'nama_barang' => 'Meja Kerja Minimalis',
                'kategori_id' => 3,
                'stok'        => 0,
            ],
            [
                'kode_barang' => 'PRB-002',
                'nama_barang' => 'Kursi Ergonomis',
                'kategori_id' => 3,
                'stok'        => 8,
            ],
        ];

        foreach ($items as $item) {
            Barang::create($item);
        }
    }
}