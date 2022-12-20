<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $prefix = "tb_";
    protected $fillable = [
        'nis',
        'nama_siswa',
        'alamat_siswa',
        'notelp_siswa',
        'id_kelas_ajaran',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status',
        'password',
        'isLogin',
        'deviceId',
        'foto_profil',
        'email',
        'otp',
        'otp_expired'
    ];
}
