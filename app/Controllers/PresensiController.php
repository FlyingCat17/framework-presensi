<?php
namespace App\Controllers;

use App\Config\Session;
use App\Controllers\Controller;
use App\Models\Kelas_Ajaran as ModelsKelasAjaran;
use App\Models\Tahun_Ajaran as ModelsTahunAjaran;
use App\Models\Jadwal as ModelsJadwal;
use Riyu\Http\Request;

class PresensiController extends Controller
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
        $data['title'] = 'Presensi';
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)->all();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        $data['kelas_ajaran'] = ModelsKelasAjaran::where('tb_kelas_ajaran.id_tahun_ajaran', '=', $data['tahun_ajar']->id_tahun_ajaran)->where('tb_kelas_ajaran.status', '1')->join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();


        return view([
            'templates/header',
            'templates/sidebar',
            'presensi/pilih_kelas',
            'templates/footer',
        ], $data);
    }

    public function kelas(Request $request)
    {
        $data['title'] = 'Presensi';
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['kelas'] = ModelsKelasAjaran::where('id_kelas_ajaran', $request->idKelasAjaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->first();
        $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        if ($data['kelas'] == false || null) {
            header('Location: ' . base_url . 'presensi');
        }
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'presensi/pilih_jadwal',
            'templates/footer',
        ], $data);
    }
}