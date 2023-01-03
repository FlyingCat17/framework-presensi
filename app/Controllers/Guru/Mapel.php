<?php

namespace App\Controllers\Guru;


use App\Config\Session;
use App\Controllers\Controller;
use App\Controllers\KelasAjaran;
use App\Models\Tahun_Ajaran;
use App\Models\User;
use App\Models\Guru;
use App\Models\Jadwal;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;


class Mapel extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }

        if (Session::get('type') != 'guru') {
            header('Location: ' . base_url . 'mapel');
            exit();
        }
    }

    public function index()
    {

        $data['title'] = 'Mata Pelajaran';
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['guru'] = Guru::where('nuptk', Session::get('user'))->first();
        $data['mapel'] = Jadwal::where('tb_jadwal.nuptk', Session::get('user'))
            ->where('tb_tahun_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->groupBy('tb_jadwal.id_mapel')
            ->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['mapel'], JSON_PRETTY_PRINT);
        return view([
            'guru/view/templates/header',
            'guru/view/templates/sidebar',
            'guru/view/mapel/index',
            'guru/view/templates/footer',
        ], $data);
    }
}