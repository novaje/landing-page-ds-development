<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiWebsite extends Model
{
    use HasFactory;

    protected $table = 'tb_koleksi_website';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'harga',
        'deskripsi',
        'upload_gambar',
    ];
}
