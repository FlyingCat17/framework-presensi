<?php
use Riyu\Database\Utils\Model;

class Jadwal extends Model
{
    protected $prefix = "tb_";
    protected $tb = "jadwal";
    protected $fillable = [
        'id_jadwal',
        'nuptk',
        'id_kelas_ajaran',
        'id_mapel',
        'jam_awal',
        'jam_akhir',
        'hari',
        'jam_ke'
    ];
}