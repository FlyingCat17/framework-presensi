<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $prefix = 'tb_';
    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'jabatan',
        'alamat',
        'notelp',
        'foto_profile',
        'isRoot'
    ];
}