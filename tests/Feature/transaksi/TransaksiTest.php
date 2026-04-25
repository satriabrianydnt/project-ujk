<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;

class TransaksiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $barang1;
    protected $barang2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $kategori = Kategori::create([
            'nama_kategori' => 'Electronics',
            'deskripsi' => 'Testing category'
        ]);

        $this->barang1 = Barang::create([
            'kategori_id' => $kategori->id,
            'kode_barang' => 'TEST-001',
            'nama_barang' => 'Test Laptop',
            'stok' => 10,
        ]);

        $this->barang2 = Barang::create([
            'kategori_id' => $kategori->id,
            'kode_barang' => 'TEST-002',
            'nama_barang' => 'Gaming Mouse',
            'stok' => 50,
        ]);

        Transaksi::create([
            'barang_id' => $this->barang1->id,
            'jenis' => 'masuk',
            'jumlah' => 5,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'keterangan' => 'Stok awal laptop'
        ]);

        Transaksi::create([
            'barang_id' => $this->barang2->id,
            'jenis' => 'keluar',
            'jumlah' => 2,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'keterangan' => 'Terjual mouse'
        ]);
    }

    public function test_incoming_transaction_increases_stock()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang1->id,
            'jenis' => 'masuk',
            'jumlah' => 5,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'keterangan' => 'Restock'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang1->id,
            'stok' => 15,
        ]);
    }

    public function test_outgoing_transaction_decreases_stock()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang1->id,
            'jenis' => 'keluar',
            'jumlah' => 3,
            'tanggal_transaksi' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang1->id,
            'stok' => 7,
        ]);
    }

    public function test_outgoing_transaction_fails_if_stock_insufficient()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang1->id,
            'jenis' => 'keluar',
            'jumlah' => 20,
            'tanggal_transaksi' => now()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors(['jumlah']);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang1->id,
            'stok' => 10,
        ]);
    }

    public function test_can_search_transaksi_by_nama_barang()
    {
        $response = $this->actingAs($this->user)->get(route('transaksi.index', ['search' => 'Laptop']));

        $response->assertStatus(200);

        $response->assertSee('Stok awal laptop');
        $response->assertDontSee('Terjual mouse');
    }

    public function test_can_search_transaksi_by_kode_barang()
    {
        $response = $this->actingAs($this->user)->get(route('transaksi.index', ['search' => 'TEST-002']));

        $response->assertStatus(200);
        $response->assertSee('Terjual mouse');
        $response->assertDontSee('Stok awal laptop');
    }

    public function test_can_filter_transaksi_by_jenis()
    {
        $response = $this->actingAs($this->user)->get(route('transaksi.index', ['jenis' => 'keluar']));

        $response->assertStatus(200);
        $response->assertSee('Terjual mouse');
        $response->assertDontSee('Stok awal laptop');
    }

    public function test_excel_export_is_downloadable()
    {
        $response = $this->actingAs($this->user)->get(route('transaksi.export.excel'));

        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
    }

    public function test_pdf_export_is_downloadable()
    {
        $response = $this->actingAs($this->user)->get(route('transaksi.export.pdf'));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }
}
