<?php
namespace App\Models;

use Riyu\Database\Utils\Model;

class Kelas_Ajaran extends Model
{
    // protected $table = "tb_kelas_ajaran";
    protected $prefix = "tb_";

    protected $fillable = [
        'id_kelas_ajaran',
        'id_kelas',
        'id_tahun_ajaran',
        'status'
    ];
}