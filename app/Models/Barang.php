<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barangs';
    protected $fillable = [
        'kode_barang', 
        'nama_barang', 
        'kategori_id', 
        'stok'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
