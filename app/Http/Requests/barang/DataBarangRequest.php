<?php

namespace App\Http\Requests\barang;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DataBarangRequest extends FormRequest
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
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique'   => 'Kode barang ini sudah terdaftar. Gunakan kode lain.',
            'kategori_id.required' => 'Silakan pilih kategori barang.',
            'stok.min'             => 'Stok tidak boleh bernilai minus.',
        ];
    }
}
