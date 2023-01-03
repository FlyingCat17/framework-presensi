<?php
namespace App\Controllers\Guru;


use App\Config\Session;
use App\Controllers\Controller;
use App\Controllers\KelasAjaran;
use App\Models\Tahun_Ajaran;
use App\Models\User;
use App\Models\Guru;
use App\Models\Jadwal as ModelsJadwal;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class Jadwal extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
        if (Session::get('type') != 'guru') {
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
    }

    private function getGuru()
    {
        return Guru::where('nuptk', Session::get('user'))->first();
    }

    private function getTahunAjaran()
    {
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        return $data['tahun_ajaran'];
    }

    # Pilih Kelas
    public function index()
    {
        $data['title'] = "Jadwal";
        $data['guru'] = $this->getGuru();
        $data['kelas'] = ModelsJadwal::where('tb_jadwal.nuptk', Session::get('user'))
            ->where('tb_tahun_ajaran.id_tahun_ajaran', $this->getTahunAjaran()->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->groupBy('tb_jadwal.id_kelas_ajaran')
            ->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        return view([
            'guru/view/templates/header',
            'guru/view/templates/sidebar',
            'guru/view/jadwal/pilih_hari',
            'guru/view/templates/footer',
        ], $data);
    }

    public function jadwalHarian(Request $request)
    {
        switch ($request->hari) {
            case '1':
                $data['title'] = "Jadwal Senin";
                break;
            case '2':
                $data['title'] = "Jadwal Selasa";
                break;
            case '3':
                $data['title'] = "Jadwal Rabu";
                break;
            case '4':
                $data['title'] = "Jadwal Kamis";
                break;
            case '5':
                $data['title'] = "Jadwal Jumat";
                break;
            default:
                $data['title'] = "Jadwal";
                break;
        }
        $data['guru'] = $this->getGuru();
        return view([
            'guru/view/templates/header',
            'guru/view/templates/sidebar',
            'guru/view/templates/footer',
        ], $data);
    }
}

?>