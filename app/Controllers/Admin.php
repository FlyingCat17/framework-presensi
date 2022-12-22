<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use App\Models\Informasi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Tahun_Ajaran;
use App\Models\kelas_Ajaran;

class Admin extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
        if (Session::get('type') == "guru") {
            header('Location: ' . base_url . 'dashboard/guru');
            exit();
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        $data['kelas'] = Kelas_Ajaran::select('COUNT(id_kelas_ajaran) AS jumlah_kelas')
            ->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)
            ->where('status', '1')
            ->first();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['siswa'] = Siswa::select('COUNT(nis) AS jumlah_siswa')->where('status', '1')->first();
        $data['guru'] = Guru::select('COUNT(nuptk) AS jumlah_guru')->where('isActive', '1')->first();
        $data['mapel'] = Mapel::select('COUNT(id_mapel) AS jumlah_mapel')->where('status', '1')->first();
        return view(['templates/header', 'templates/sidebar', 'home/index', 'templates/footer'], $data);
    }
}