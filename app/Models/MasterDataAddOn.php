<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataAddOn extends Model
{
    use HasFactory;
    
    protected $table = 'tb_master_data_add_on';
    protected $primaryKey = 'id_add_on';
    protected $fillable = [
        'nm_add_on',
        'harga_jual',
        'modal_vendor',
        'catatan',
    ];
}
