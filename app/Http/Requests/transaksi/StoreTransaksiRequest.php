<?php

namespace App\Http\Requests\transaksi;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'barang_id'         => 'required|exists:barangs,id',
            'jenis'             => 'required|in:masuk,keluar',
            'jumlah'            => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
            'keterangan'        => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'barang_id.required'         => 'Silakan pilih barang terlebih dahulu.',
            'barang_id.exists'           => 'Barang yang dipilih tidak ditemukan di database.',
            'jenis.required'             => 'Jenis transaksi harus ditentukan.',
            'jenis.in'                   => 'Jenis transaksi tidak valid.',
            'jumlah.required'            => 'Jumlah barang wajib diisi.',
            'jumlah.integer'             => 'Jumlah barang harus berupa angka.',
            'jumlah.min'                 => 'Jumlah barang minimal adalah 1.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date'     => 'Format tanggal tidak valid.',
            'keterangan.max'             => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
