<?php

namespace App\Http\Controllers\transaksi;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\transaksi\StoreTransaksiRequest;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barangs = Barang::orderBy('nama_barang', 'asc')->get();

        $query = Transaksi::with('barang');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $transaksis = $query->latest()->paginate(10)->withQueryString();

        return view('dashboard.transaksi', compact('barangs', 'transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $barang = Barang::findOrFail($request->barang_id);

                if ($request->jenis === 'keluar') {
                    if ($barang->stok < $request->jumlah) {
                        throw new \Exception('Stok tidak mencukupi! Sisa stok saat ini: ' . $barang->stok . ' unit.');
                    }
                    $barang->decrement('stok', $request->jumlah);
                } else {
                    $barang->increment('stok', $request->jumlah);
                }

                Transaksi::create($request->validated());
            });

            Alert::toast('Data berhasil disimpan!', 'success')->position('top-end');

            return back();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['jumlah' => $e->getMessage()]);
        }
    }

    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'Laporan_Transaksi_' . date('d-m-Y') . '.xlsx');
    }

    public function exportPdf()
    {
        $transaksis = Transaksi::with('barang')->latest()->get();
        $pdf = Pdf::loadView('export.export-pdf', compact('transaksis'));

        return $pdf->download('Laporan_Transaksi_' . date('d-m-Y') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
