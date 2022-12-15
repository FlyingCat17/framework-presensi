<?php
namespace App\Controllers;

use App\Config\Session;
use App\Controllers\Controller;
use App\Models\Kelas_Ajaran as ModelsKelasAjaran;
use App\Models\Tahun_Ajaran as ModelsTahunAjaran;
use App\Models\Kelas as ModelsKelas;
use App\Models\Siswa as ModelsSiswa;
use Riyu\Http\Request;
use Utils\Flasher;

class KelasAjaran extends Controller
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
        $data['title'] = "Pembagian Kelas";
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)->all();
        $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        // $query = "SELECT * FROM tb_kelas_ajaran JOIN tb_kelas ON tb_kelas.id_kelas = tb_kelas_ajaran.id_kelas WHERE tb_kelas_ajaran.status = '1' AND tb_kelas_ajaran.id_tahun_ajaran = '" . $data['tahun_ajar']->id_tahun_ajaran . "' ORDER BY tb_kelas.nama_kelas ASC";
        // header('Content-Type: application/json');
        // echo json_encode($getKelasAjaran, JSON_PRETTY_PRINT);
        return view(['templates/header', 'templates/sidebar', 'kelas/bagi/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Pembagian Kelas";

        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['kelas'] = ModelsKelas::where('status', '1')->all();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'kelas/bagi/tambah',
            'templates/footer'
        ], $data);
    }
    public function insert(Request $request)
    {
        ModelsKelasAjaran::insert([
            'id_kelas_ajaran' => '',
            'id_kelas' => $request->nama_kelas,
            'id_tahun_ajaran' => $request->id,
            'status' => '1'
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan', 'success');
        header('location: ' . base_url . 'kelas/bagi/tambah');
        exit();
    }

    public function delete(Request $request)
    {
        ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->delete()->save();
        Flasher::setFlash('Berhasil Dihapus!', 'success');
        header('location: ' . base_url . 'kelas/bagi');
        exit();
    }
    public function check()
    {
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', '=', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->all();
        $data['kelas_ajaran'] = ModelsKelasAjaran::where('status', '1')->all();
        header('Content-Type: application/json');
        // echo json_encode($data['tahun_ajar'], JSON_PRETTY_PRINT);
        echo json_encode($data['kelas_ajaran'], JSON_PRETTY_PRINT);
    }

    public function detail(Request $request)
    {
        $check = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->first();
        if (!$check) {
            header('Location: ' . base_url . 'kelas/bagi');
            exit();
        }
        $data['kelas'] = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->first();
        $data['siswa'] = ModelsSiswa::where('id_kelas_ajaran', $request->id)->all();
        $data['title'] = "Pembagian Kelas";
        return view([
            'templates/header',
            'templates/sidebar',
            'kelas/bagi/detail',
            'templates/footer'
        ], $data);
    }
}