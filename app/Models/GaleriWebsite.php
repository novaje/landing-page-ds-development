<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriWebsite extends Model
{
    use HasFactory;

    protected $table = 'tb_galeri_website';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'deskripsi',
        'upload_gambar',
    ];
}
