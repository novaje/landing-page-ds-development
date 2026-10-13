<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangWebsite extends Model
{
    use HasFactory;
    protected $table = 'tb_tentang_website';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'deskripsi',
        'upload_gambar',
    ];
}
