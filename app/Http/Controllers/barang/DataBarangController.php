<?php

namespace App\Http\Controllers\barang;

use App\Http\Controllers\Controller;
use App\Http\Requests\barang\DataBarangRequest;
use App\Http\Requests\barang\UpdateBarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $query = Barang::with('kategori')->latest();

        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $query->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%$search%")
                    ->orWhere('kode_barang', 'like', "%$search%");
            });
        });

        $query->when($kategori, function ($q) use ($kategori) {
            $q->where('kategori_id', $kategori);
        });

        $barangs = $query->paginate(5)->withQueryString();

        return view('dashboard.data-barang', compact('barangs', 'kategoris'));
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
    public function store(DataBarangRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['stok'] = $validatedData['stok'] ?? 0;
        Barang::create($validatedData);

        Alert::toast('Data barang berhasil ditambahkan!', 'success')->position('top-end');
        return back();
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
    public function update(UpdateBarangRequest $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $validatedData = $request->validated();

        $barang->update($validatedData);

        Alert::toast('Data barang berhasil diperbarui!', 'success')->position('top-end');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        Alert::toast('Data barang berhasil dihapus!', 'success')->position('top-end');
        return back();
    }
}
