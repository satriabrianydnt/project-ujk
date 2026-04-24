<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalStok = Barang::sum('stok');

        $barangMasukHariIni = 0;
        $barangKeluarHariIni = 0;

        $recentBarangs = Barang::with('kategori')->latest()->take(5)->get();

        return view('dashboard.dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalStok',
            'barangMasukHariIni',
            'barangKeluarHariIni',
            'recentBarangs'
        ));
    }
}
