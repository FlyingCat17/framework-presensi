<?php
namespace App\Controllers\Guru;


use App\Config\Session;
use App\Controllers\Controller;
use App\Controllers\KelasAjaran;
use App\Models\User;
use App\Models\Kelas_Ajaran;
use App\Models\Tahun_Ajaran;
use App\Models\Jadwal;
use App\Models\Guru;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class Dashboard extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }

        if (Session::get('type') != 'guru') {
            redirect(base_url . 'dashboard');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Guru";
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['guru'] = Guru::where('nuptk', Session::get('user'))->first();
        $data['kelas'] = Jadwal::where('tb_jadwal.nuptk', Session::get('user'))
            ->where('tb_tahun_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->groupBy('tb_jadwal.id_kelas_ajaran')
            ->count();
        $data['mapel'] = Jadwal::where('tb_jadwal.nuptk', Session::get('user'))
            ->where('tb_tahun_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->groupBy('tb_jadwal.id_mapel')
            ->count();
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);

        return view([
            'guru/view/templates/header',
            'guru/view/templates/sidebar',
            'guru/view/dashboard/index',
            'guru/view/templates/footer',
        ], $data);
    }
}