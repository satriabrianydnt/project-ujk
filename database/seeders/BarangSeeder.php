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
            // --- KATEGORI 1: ELEKTRONIK ---
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
                'kode_barang' => 'ELC-003',
                'nama_barang' => 'Monitor Dell UltraSharp 27',
                'kategori_id' => 1,
                'stok'        => 8,
            ],
            [
                'kode_barang' => 'ELC-004',
                'nama_barang' => 'Keyboard Keychron K2',
                'kategori_id' => 1,
                'stok'        => 0, // Sengaja dihabiskan
            ],

            // --- KATEGORI 2: ALAT TULIS KANTOR ---
            [
                'kode_barang' => 'ATK-001',
                'nama_barang' => 'Kertas A4 80gr (Rim)',
                'kategori_id' => 2,
                'stok'        => 50,
            ],
            [
                'kode_barang' => 'ATK-002',
                'nama_barang' => 'Pulpen Faster Hitam (Pack)',
                'kategori_id' => 2,
                'stok'        => 25,
            ],
            [
                'kode_barang' => 'ATK-003',
                'nama_barang' => 'Spidol Whiteboard Snowman',
                'kategori_id' => 2,
                'stok'        => 15,
            ],

            // --- KATEGORI 3: PERABOTAN ---
            [
                'kode_barang' => 'PRB-001',
                'nama_barang' => 'Meja Kerja Minimalis',
                'kategori_id' => 3,
                'stok'        => 0, // Sengaja dihabiskan
            ],
            [
                'kode_barang' => 'PRB-002',
                'nama_barang' => 'Kursi Ergonomis',
                'kategori_id' => 3,
                'stok'        => 8,
            ],
            [
                'kode_barang' => 'PRB-003',
                'nama_barang' => 'Lemari Arsip Besi 4 Pintu',
                'kategori_id' => 3,
                'stok'        => 3,
            ],

            // --- KATEGORI 4: LOGISTIK ---
            [
                'kode_barang' => 'LOG-001',
                'nama_barang' => 'Kardus Packing Polos (Sedang)',
                'kategori_id' => 4,
                'stok'        => 100,
            ],
            [
                'kode_barang' => 'LOG-002',
                'nama_barang' => 'Lakban Bening Daimaru',
                'kategori_id' => 4,
                'stok'        => 40,
            ],
        ];

        foreach ($items as $item) {
            Barang::create($item);
        }
    }
}