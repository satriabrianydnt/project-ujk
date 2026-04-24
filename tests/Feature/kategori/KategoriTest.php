<?php

namespace Tests\Feature\kategori;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_can_view_kategori_page_with_items_count()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);

        $response = $this->get('/kategori-barang');

        $response->assertStatus(200);
        $response->assertSee('Elektronik');
        $response->assertSee('0 Item');
    }

    public function test_user_can_search_kategori()
    {
        $user = User::factory()->create();

        Kategori::create(['nama_kategori' => 'Kategori Alfa']);
        Kategori::create(['nama_kategori' => 'Kategori Beta']);

        $response = $this->actingAs($user)->get('/kategori-barang?search=Beta');

        $response->assertStatus(200);
        $response->assertSee('Kategori Beta');
        $response->assertDontSee('Kategori Alfa');
    }

    public function test_user_cannot_store_empty_kategori()
    {
        $response = $this->post('/kategori-barang', [
            'nama_kategori' => ''
        ]);

        $response->assertSessionHasErrors('nama_kategori');
        $this->assertDatabaseCount('kategoris', 0);
    }

    public function test_user_cannot_store_duplicate_kategori()
    {
        Kategori::create(['nama_kategori' => 'Elektronik']);

        $response = $this->post('/kategori-barang', [
            'nama_kategori' => 'Elektronik'
        ]);

        $response->assertSessionHasErrors('nama_kategori');
        $this->assertDatabaseCount('kategoris', 1);
    }

    public function test_user_can_store_new_kategori_successfully()
    {
        $response = $this->post('/kategori-barang', [
            'nama_kategori' => 'Alat Kesehatan'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $this->assertDatabaseHas('kategoris', [
            'nama_kategori' => 'Alat Kesehatan'
        ]);
    }

    public function test_user_can_store_kategori_with_deskripsi()
    {
        $response = $this->post('/kategori-barang', [
            'nama_kategori' => 'Alat Kantor',
            'deskripsi' => 'Semua peralatan penunjang kerja kantor'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('kategoris', [
            'nama_kategori' => 'Alat Kantor',
            'deskripsi' => 'Semua peralatan penunjang kerja kantor'
        ]);
    }

    public function test_user_can_update_kategori_including_deskripsi()
    {
        $kategori = Kategori::create([
            'nama_kategori' => 'Lama',
            'deskripsi' => 'Deskripsi Lama'
        ]);

        $response = $this->put("/kategori-barang/{$kategori->id}", [
            'kategori_id' => $kategori->id,
            'nama_kategori' => 'Baru',
            'deskripsi' => 'Deskripsi Baru'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('kategoris', [
            'id' => $kategori->id,
            'nama_kategori' => 'Baru',
            'deskripsi' => 'Deskripsi Baru'
        ]);
    }

    public function test_user_can_delete_kategori_softly()
    {
        $user = User::factory()->create();
        $kategori = Kategori::create(['nama_kategori' => 'Hapus Halus']);

        $response = $this->actingAs($user)->delete("/kategori-barang/{$kategori->id}");

        $response->assertStatus(302);

        $this->assertSoftDeleted('kategoris', [
            'id' => $kategori->id,
            'nama_kategori' => 'Hapus Halus'
        ]);
    }

    public function test_update_validation_ignores_current_kategori_name()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);

        $response = $this->put("/kategori-barang/{$kategori->id}", [
            'kategori_id' => $kategori->id,
            'nama_kategori' => 'Elektronik',
            'deskripsi' => 'Update deskripsi saja'
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('kategoris', [
            'id' => $kategori->id,
            'deskripsi' => 'Update deskripsi saja'
        ]);
    }
}
