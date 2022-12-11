<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class Tahun_Ajaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $prefix = "tb_";
    protected $fillable = [
        'id_tahun_ajaran',
        'tahun_ajaran',
        'isActive',
        'status'
    ];
}
