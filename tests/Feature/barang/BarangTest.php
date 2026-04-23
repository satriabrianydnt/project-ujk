<?php

namespace Tests\Feature\barang;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    // Test View Data Barang
    public function test_user_can_view_data_barang_page()
    {
        $response = $this->get('/data-barang');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.data-barang');
        $response->assertViewHasAll(['barangs', 'kategoris']);
    }


    // Test Cari Barang
    public function test_user_can_search_barang_by_name_or_code()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);

        Barang::create([
            'kode_barang' => 'ELC-MATCH',
            'nama_barang' => 'Target Search',
            'kategori_id' => $kategori->id,
            'stok'        => 5
        ]);

        Barang::create([
            'kode_barang' => 'ELC-OTHER',
            'nama_barang' => 'Ignore This',
            'kategori_id' => $kategori->id,
            'stok'        => 5
        ]);


        $response = $this->get('/data-barang?search=Target');
        $response->assertStatus(200);
        $response->assertSee('Target Search');
        $response->assertDontSee('Ignore This');

        $response = $this->get('/data-barang?search=MATCH');
        $response->assertStatus(200);
        $response->assertSee('ELC-MATCH');
        $response->assertDontSee('Ignore This');
    }

    public function test_user_can_filter_barang_by_category()
    {
        $katElektronik = Kategori::create(['nama_kategori' => 'Elektronik']);
        $katMebel = Kategori::create(['nama_kategori' => 'Mebel']);

        Barang::create([
            'kode_barang' => 'ELC-001',
            'nama_barang' => 'Laptop Acer',
            'kategori_id' => $katElektronik->id,
            'stok'        => 5
        ]);

        Barang::create([
            'kode_barang' => 'MBL-001',
            'nama_barang' => 'Kursi Kayu',
            'kategori_id' => $katMebel->id,
            'stok'        => 5
        ]);

        $response = $this->get("/data-barang?kategori={$katElektronik->id}");

        $response->assertStatus(200);
        $response->assertSee('Laptop Acer');
        $response->assertDontSee('Kursi Kayu');
    }

    // Test Simpan Data Barang
    public function test_user_cannot_store_barang_with_empty_data()
    {
        $response = $this->post('/data-barang', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['nama_barang', 'kode_barang', 'kategori_id']);

        $this->assertDatabaseCount('barangs', 0);
    }

    public function test_user_cannot_store_barang_with_duplicate_kode_barang()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);
        Barang::create([
            'kode_barang' => 'ELC-001',
            'nama_barang' => 'Barang Lama',
            'kategori_id' => $kategori->id,
            'stok'        => 5
        ]);

        $response = $this->post('/data-barang', [
            'nama_barang' => 'Barang Baru',
            'kode_barang' => 'ELC-001',
            'kategori_id' => $kategori->id,
            'stok'        => 10
        ]);

        $response->assertSessionHasErrors(['kode_barang']);
        $this->assertDatabaseCount('barangs', 1);
    }

    public function test_user_can_store_new_barang_successfully()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Perabotan']);

        $response = $this->post('/data-barang', [
            'nama_barang' => 'Lemari Besi',
            'kode_barang' => 'PRB-999',
            'kategori_id' => $kategori->id,
            'stok'        => 20
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('barangs', [
            'kode_barang' => 'PRB-999',
            'nama_barang' => 'Lemari Besi',
            'stok'        => 20
        ]);
    }

    // Test Update Data Barang
    public function test_user_can_update_barang_successfully()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Alat Tulis']);
        $barang = Barang::create([
            'kode_barang' => 'ATK-001',
            'nama_barang' => 'Buku Tulis Lama',
            'kategori_id' => $kategori->id,
            'stok'        => 10
        ]);

        $response = $this->put("/data-barang/{$barang->id}", [
            'id'          => $barang->id,
            'nama_barang' => 'Buku Tulis Baru (Revisi)',
            'kode_barang' => 'ATK-001',
            'kategori_id' => $kategori->id,
            'stok'        => 15
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $this->assertDatabaseHas('barangs', [
            'id'          => $barang->id,
            'nama_barang' => 'Buku Tulis Baru (Revisi)',
            'stok'        => 15
        ]);
    }

    public function test_user_cannot_update_with_existing_kode_barang()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);

        Barang::create([
            'kode_barang' => 'ELC-001',
            'nama_barang' => 'Laptop A',
            'kategori_id' => $kategori->id,
            'stok'        => 5
        ]);

        $barangB = Barang::create([
            'kode_barang' => 'ELC-002',
            'nama_barang' => 'Laptop B',
            'kategori_id' => $kategori->id,
            'stok'        => 5
        ]);

        $response = $this->put("/data-barang/{$barangB->id}", [
            'id'          => $barangB->id,
            'nama_barang' => 'Laptop B Berubah',
            'kode_barang' => 'ELC-001',
            'kategori_id' => $kategori->id,
            'stok'        => 10
        ]);

        $response->assertSessionHasErrors(['kode_barang']);
    }

    // Test Soft Delete Barang
    public function test_user_can_soft_delete_barang()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Perabotan']);
        $barang = Barang::create([
            'kode_barang' => 'PRB-001',
            'nama_barang' => 'Meja Kayu',
            'kategori_id' => $kategori->id,
            'stok'        => 2
        ]);

        $response = $this->delete("/data-barang/{$barang->id}");

        $response->assertStatus(302);

        $this->assertSoftDeleted('barangs', [
            'id' => $barang->id,
        ]);
    }
}
