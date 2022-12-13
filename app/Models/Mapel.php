<?php
namespace App\Models;

use Riyu\Database\Utils\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $prefix = 'tb_';
    protected $fillable = [
        'id_mapel',
        'nama_mapel',
        'status'
    ];
}