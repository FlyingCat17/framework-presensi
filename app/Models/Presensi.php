<?php
namespace App\Models;

use Riyu\Database\Utils\Model;

class Presensi extends Model
{
    protected $prefix = "tb_";
    protected $tb = "presensi";
    protected $fillable = [
        'id_presensi',
        'id_jadwal',
        'mulai_presensi',
        'akhir_presensi'
    ];
}