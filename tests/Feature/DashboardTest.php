<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_user_can_view_dashboard_page()
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('Selamat datang kembali');
    }

    public function test_dashboard_displays_correct_basic_statistics()
    {
        $categoryElectronics = Kategori::create(['nama_kategori' => 'Elektronik']);
        $categoryFurniture = Kategori::create(['nama_kategori' => 'Mebel']);

        Barang::create(['kode_barang' => 'BRG-001', 'nama_barang' => 'Laptop A', 'kategori_id' => $categoryElectronics->id, 'stok' => 10]);
        Barang::create(['kode_barang' => 'BRG-002', 'nama_barang' => 'Laptop B', 'kategori_id' => $categoryElectronics->id, 'stok' => 10]);
        Barang::create(['kode_barang' => 'BRG-003', 'nama_barang' => 'Meja Kerja', 'kategori_id' => $categoryFurniture->id, 'stok' => 5]);

        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertViewHas('totalKategori', 2);
        $response->assertViewHas('totalBarang', 3);
        $response->assertViewHas('totalStok', 25);
        $response->assertSee('Laptop A');
        $response->assertSee('Meja Kerja');
    }

    public function test_dashboard_calculates_todays_transactions_correctly()
    {
        $category = Kategori::create(['nama_kategori' => 'Elektronik']);
        $item = Barang::create(['kode_barang' => 'BRG-001', 'nama_barang' => 'Laptop', 'kategori_id' => $category->id, 'stok' => 10]);

        Transaksi::create([
            'barang_id' => $item->id,
            'jenis' => 'masuk',
            'jumlah' => 15,
            'tanggal_transaksi' => Carbon::today(),
            'created_at' => Carbon::now(),
        ]);

        Transaksi::create([
            'barang_id' => $item->id,
            'jenis' => 'keluar',
            'jumlah' => 4,
            'tanggal_transaksi' => Carbon::today(),
            'created_at' => Carbon::now(),
        ]);

        $response = $this->actingAs($this->user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('barangMasukHariIni', 15);
        $response->assertViewHas('barangKeluarHariIni', 4);
    }

    public function test_dashboard_supports_time_range_filter_for_charts()
    {
        $response1d = $this->actingAs($this->user)->get('/dashboard?range=1d');
        $response1d->assertStatus(200);
        $response1d->assertViewHas('range', '1d');
        $response1d->assertViewHas('dates', function ($dates) {
            return count($dates) === 24;
        });

        $response7d = $this->actingAs($this->user)->get('/dashboard?range=7d');
        $response7d->assertStatus(200);
        $response7d->assertViewHas('range', '7d');
        $response7d->assertViewHas('dates', function ($dates) {
            return count($dates) === 7;
        });

        $response30d = $this->actingAs($this->user)->get('/dashboard?range=30d');
        $response30d->assertStatus(200);
        $response30d->assertViewHas('range', '30d');
        $response30d->assertViewHas('dates', function ($dates) {
            return count($dates) === 30;
        });
    }
}