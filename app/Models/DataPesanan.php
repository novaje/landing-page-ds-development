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
        'add_on_pesanan',
        'dp_pembayaran',
        'dp_masuk',
        'tgl_selesai',
        'tgl_pelunasan',
        'nominal_pelunasan',
        'status_order',        
        'status_pesanan',
        'total_order',
        'harga_netto',
        'total_hpp',
        'laba_kotor',
        'sisa_piutang'
    ];
}
