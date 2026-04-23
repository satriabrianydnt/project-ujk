<?php

namespace App\Http\Requests\barang;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
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
            'kode_barang' => [
                'required',
                'string',
                'max:50',
                Rule::unique('barangs', 'kode_barang')->ignore($this->id),
            ],
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique'   => 'Kode barang ini sudah dipakai oleh barang lain.',
            'kategori_id.required' => 'Silakan pilih kategori barang.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}
