<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakWebsite extends Model
{
    use HasFactory;

    protected $table = 'tb_kontak_website';
    protected $primaryKey = 'id_kontak_website';

    protected $fillable = [
        'nm_kontak',
        'email',
        'pesan',
        'alamat',
    ];
}
