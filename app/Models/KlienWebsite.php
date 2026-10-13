<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlienWebsite extends Model
{
    use HasFactory;

    protected $table = 'tb_klien_website';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nm_klien',
        'nm_team',
    ];
}
