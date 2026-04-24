<?php

namespace App\Http\Controllers\barang;

use App\Http\Controllers\Controller;
use App\Http\Requests\kategori\StoreKategoriRequest;
use App\Http\Requests\kategori\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::withCount('barang')->latest();

        $query->when($request->search, function ($q) use ($request) {
            $q->where('nama_kategori', 'like', '%' . $request->search . '%');
        });

        $kategoris = $query->paginate(5);

        return view('dashboard.kategori-barang', compact('kategoris'));
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
    public function store(StoreKategoriRequest $request)
    {
        $validatedData = $request->validated();
        Kategori::create($validatedData);

        Alert::toast('Kategori baru berhasil ditambahkan!', 'success')->position('top-end');
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
    public function update(UpdateKategoriRequest $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validatedData = $request->validated();

        $kategori->update($validatedData);

        Alert::toast('Kategori berhasil diperbarui!', 'success')->position('top-end');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        Alert::toast('Kategori berhasil dihapus!', 'success')->position('top-end');
        return back();
    }
}
