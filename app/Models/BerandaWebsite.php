<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerandaWebsite extends Model
{
    use HasFactory;

    protected $table = 'tb_beranda_website';
    protected $primaruyKey = 'id';

    protected $fillable = [
        'judul',
        'deskripsi',
        'upload_gambar',
    ];
}
