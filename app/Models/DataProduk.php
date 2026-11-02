<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;

    protected $table = 'tb_data_produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'kode_produk',
        'nm_produk',
        'nm_bahan',
        'ukuran',
        'harga_jual',
        'motif',
        'stok',
        'status',
        'sisa',
        'upload_gambar'
    ];
}
