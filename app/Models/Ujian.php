<?php
namespace App\Models;

use Riyu\Database\Utils\Model;

class Ujian extends Model
{
    protected $prefix = 'tb_';
    protected $table = 'ujian';

    protected $fillable = [
        'id_kelas_ajaran',
        'id_mapel',
        'date_ujian',
        'jenis_ujian',
        'hari',
    ];
}