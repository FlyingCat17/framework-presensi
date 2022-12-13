<?php 
namespace App\Models;

use Riyu\Database\Utils\Model;

class Guru extends Model
{
    protected $prefix = "tb_";
    // protected $table = "tb_guru";
    protected $fillable = [
        'nuptk',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_guru',
        'notelp_guru',
        'password',
        'status_kepegawaian',
        'isActive'
    ];
}