<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataPaketJersey extends Model
{
    use HasFactory;

    protected $table = 'tb_master_data_paket_jersey';
    protected $primaryKey = 'id_paket';
    protected $fillable = [
        'nm_paket',
        'harga_jual',
        'modal_vendor',
        'ongkir_pcs',
        'margin_pcs',
    ];
}
