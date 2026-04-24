<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalStok = Barang::sum('stok');

        $hariIni = Carbon::today();
        $barangMasukHariIni = Transaksi::where('jenis', 'masuk')->whereDate('tanggal_transaksi', $hariIni)->sum('jumlah');
        $barangKeluarHariIni = Transaksi::where('jenis', 'keluar')->whereDate('tanggal_transaksi', $hariIni)->sum('jumlah');

        $recentBarangs = Barang::with('kategori')->latest()->take(5)->get();

        $range = $request->get('range', '7d');
        $dates = [];
        $masukData = [];
        $keluarData = [];

        if ($range === '1d') {
            $masukRaw = Transaksi::where('jenis', 'masuk')
                ->whereDate('tanggal_transaksi', $hariIni)
                ->get()
                ->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('H');
                });

            $keluarRaw = Transaksi::where('jenis', 'keluar')
                ->whereDate('tanggal_transaksi', $hariIni)
                ->get()
                ->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('H');
                });

            for ($i = 0; $i < 24; $i++) {
                $hourKey = str_pad($i, 2, '0', STR_PAD_LEFT);
                $dates[] = $hourKey . ':00';

                $masukData[] = isset($masukRaw[$hourKey]) ? $masukRaw[$hourKey]->sum('jumlah') : 0;
                $keluarData[] = isset($keluarRaw[$hourKey]) ? $keluarRaw[$hourKey]->sum('jumlah') : 0;
            }
        } else {
            $daysCount = ($range === '30d') ? 30 : 7;
            for ($i = $daysCount - 1; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $dates[] = $date->format('d M');
                $masukData[] = Transaksi::where('jenis', 'masuk')->whereDate('tanggal_transaksi', $date)->sum('jumlah');
                $keluarData[] = Transaksi::where('jenis', 'keluar')->whereDate('tanggal_transaksi', $date)->sum('jumlah');
            }
        }

        $kategoriLabels = [];
        $kategoriData = [];
        $kategoriList = Kategori::all();

        foreach ($kategoriList as $kat) {
            $kategoriLabels[] = $kat->nama_kategori;
            $kategoriData[] = (int) Barang::where('kategori_id', $kat->id)->sum('stok');
        }

        if (empty($kategoriLabels)) {
            $kategoriLabels = ['Belum Ada Kategori'];
            $kategoriData = [0];
        }

        return view('dashboard.dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalStok',
            'barangMasukHariIni',
            'barangKeluarHariIni',
            'recentBarangs',
            'dates',
            'masukData',
            'keluarData',
            'kategoriLabels',
            'kategoriData',
            'range'
        ));
    }
}
