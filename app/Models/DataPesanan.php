<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_data_pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'tgl_pesanan',
        'kode_pesanan',
        'nama_team',
        'jenis_pesanan',
        'qty_pesanan',
        'total_modal_pesanan',
        'total_jual',
        'sisa',
        'status_pesanan'
    ];
}
