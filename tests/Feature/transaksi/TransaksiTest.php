<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;

class TransaksiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $barang;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $kategori = Kategori::create([
            'nama_kategori' => 'Electronics',
            'deskripsi' => 'Testing category'
        ]);

        $this->barang = Barang::create([
            'kategori_id' => $kategori->id,
            'kode_barang' => 'TEST-001',
            'nama_barang' => 'Test Laptop',
            'stok' => 10,
        ]);
    }

    public function test_incoming_transaction_increases_stock()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang->id,
            'jenis' => 'masuk',
            'jumlah' => 5,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'keterangan' => 'Restock'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang->id,
            'stok' => 15,
        ]);
    }

    public function test_outgoing_transaction_decreases_stock()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang->id,
            'jenis' => 'keluar',
            'jumlah' => 3,
            'tanggal_transaksi' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang->id,
            'stok' => 7,
        ]);
    }

    public function test_outgoing_transaction_fails_if_stock_insufficient()
    {
        $response = $this->actingAs($this->user)->post(route('transaksi.store'), [
            'barang_id' => $this->barang->id,
            'jenis' => 'keluar',
            'jumlah' => 20,
            'tanggal_transaksi' => now()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors(['jumlah']);
        $this->assertDatabaseHas('barangs', [
            'id' => $this->barang->id,
            'stok' => 10,
        ]);
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