<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class Kelas extends Model{
    protected $table = 'kelas';
    protected $prefix = 'tb_';
    protected $fillable = [
        'id_kelas',
        'nama_kelas',
        'status'
    ];
}