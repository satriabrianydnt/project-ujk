<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function test_user_can_view_dashboard_page()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Selamat datang kembali');
    }

    public function test_dashboard_displays_correct_statistics()
    {

        $user = User::factory()->create();

        $katElektronik = Kategori::create(['nama_kategori' => 'Elektronik']);
        $katMebel = Kategori::create(['nama_kategori' => 'Mebel']);

        Barang::create(['kode_barang' => 'BRG-001', 'nama_barang' => 'Laptop A', 'kategori_id' => $katElektronik->id, 'stok' => 10]);
        Barang::create(['kode_barang' => 'BRG-002', 'nama_barang' => 'Laptop B', 'kategori_id' => $katElektronik->id, 'stok' => 10]);
        Barang::create(['kode_barang' => 'BRG-003', 'nama_barang' => 'Meja Kerja', 'kategori_id' => $katMebel->id, 'stok' => 5]);

        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);

        $response->assertSeeText('2');
        $response->assertSeeText('3');
        $response->assertSeeText('25');
        $response->assertSee('Laptop A');
        $response->assertSee('Meja Kerja');
    }
}
