<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class Informasi extends Model
{
    protected $prefix = "tb_";

    protected $fillable = [
        'id_informasi',
        'judul_informasi',
        'isi_informasi',
        'created_at',
        'thumbnail'
    ];
}