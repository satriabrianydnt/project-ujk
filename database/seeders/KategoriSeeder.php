<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Faker\Factory;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi'     => 'Perangkat keras, gadget, dan komponen elektronik.'
            ],
            [
                'nama_kategori' => 'Alat Tulis Kantor',
                'deskripsi'     => 'Kebutuhan tulis-menulis dan perlengkapan meja kantor.'
            ],
            [
                'nama_kategori' => 'Perabotan',
                'deskripsi'     => 'Meja, kursi, lemari, dan infrastruktur ruangan.'
            ],
            [
                'nama_kategori' => 'Logistik',
                'deskripsi'     => 'Barang-barang pendukung operasional gudang.'
            ],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }

        // $faker = Factory::create('id_ID');
        // for ($i = 1; $i <= 20; $i++) {
        //     Kategori::create([
        //         'nama_kategori' => 'Kategori Dummy ' . $i,
        //         'deskripsi'     => $faker->sentence(10)
        //     ]);
        // }
    }
}
