<?php
namespace App\Controllers;

use App\Config\Controller;
use App\Config\Session;
use App\Models\Jadwal as ModelsJadwal;
use App\Models\Tahun_Ajaran;
use App\Models\Kelas_Ajaran;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\User;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class JadwalController extends Controller
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
        $data['title'] = "Jadwal";
        // $id_tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        // $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
        //     ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
        //     ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
        //     ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
        //     ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
        //     ->where('tb_kelas_ajaran.id_tahun_ajaran', $id_tahun_ajaran->id_tahun_ajaran)
        //     ->orderBy('tb_jadwal.hari', 'asc')
        //     ->orderBy('tb_jadwal.jam_awal', 'asc')
        //     ->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['jadwal'], JSON_PRETTY_PRINT);
        $data['tahun_ajar'] = Tahun_Ajaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)->all();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        $data['kelas_ajaran'] = Kelas_Ajaran::where('tb_kelas_ajaran.id_tahun_ajaran', '=', $data['tahun_ajar']->id_tahun_ajaran)->where('tb_kelas_ajaran.status', '1')->join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/Kelas/index',
            'templates/footer',
        ], $data);
        // echo 'jadwal/index';
    }

    public function jadwalKelas(Request $request, $idKelasAjaran)
    {
        $data['title'] = "Jadwal";
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['kelas'] = Kelas_Ajaran::where('id_kelas_ajaran', $request->idKelasAjaran)
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
        $data['jadwalSenin'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_jadwal.hari', '1')
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        $data['jadwalSelasa'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_jadwal.hari', '2')
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        $data['jadwalRabu'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_jadwal.hari', '3')
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        $data['jadwalKamis'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_jadwal.hari', '4')
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        $data['jadwalJumat'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->where('tb_jadwal.hari', '5')
            ->where('tb_kelas_ajaran.id_kelas_ajaran', $request->idKelasAjaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        if ($data['kelas'] == null) {
            Flasher::setFlash('Kelas Tidak Ditemukan!', 'danger');
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/index',
            'templates/footer'
        ], $data);
    }
    public function tambah(Request $request, $idKelasAjaran)
    {
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['check_kelas'] = Kelas_Ajaran::where('id_kelas_ajaran', $request->idKelasAjaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->first();
        if ($data['check_kelas'] == null) {
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['kelas'] = Kelas_Ajaran::where('id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->all();
        $data['mapel'] = Mapel::select()->all();
        $data['guru'] = Guru::select()->all();
        $data['title'] = "Jadwal";
        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/tambah_jadwal',
            'templates/footer',
        ], $data);
    }

    public function detail(Request $request, $id)
    {
        $data['title'] = "Jadwal";
        $tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_jadwal.id_jadwal', $id)
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)
            ->first();
        if ($data['jadwal'] == false) {
            header('location: ' . base_url . 'jadwal');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/detail_jadwal',
            'templates/footer',
        ], $data);
        // header('Content-Type: application/json');
        // echo json_encode($data['jadwal'], JSON_PRETTY_PRINT);
    }

    public function insert(Request $request)
    {
        $insert_data = [
            'id_kelas' => $request->get_kelas,
            'id_mapel' => $request->get_mapel,
            'nuptk' => $request->get_guru,
            'hari' => $request->get_hari,
            'jam_awal' => $request->get_jam_awal,
            'jam_akhir' => $request->get_jam_akhir,
            'get_jam_ke' => $request->get_jam_ke,
        ];
        $rules = [
            'jam_awal' => 'required|max:10',
            'jam_akhir' => 'required|max:10',
            'get_jam_ke' => 'required|max:2',
        ];
        $errors = Validation::make($insert_data, $rules);
        if ($errors) {
            Flasher::setFlash('Gagal Ditambahkan!', 'danger');
            header('Location: ' . base_url . 'jadwal/kelas/' . $request->idKelasAjaran . '/tambah');
            exit();
        }

        $validatehtml = [
            'jam_awal' => htmlspecialchars($request->get_jam_awal),
            'jam_akhir' => htmlspecialchars($request->get_jam_akhir),
            'jam_ke' => htmlspecialchars($request->get_jam_ke)
        ];
        $jam_keVal = $validatehtml['jam_ke'];
        // echo $jam_keVal;
        if (!is_numeric($jam_keVal)) {
            Flasher::setFlash('Gagal Ditambahkan! Jam Pertemeuan harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'jadwal/tambah');
            exit();
        }

        ModelsJadwal::insert([
            'id_jadwal' => '',
            'nuptk' => $request->get_guru,
            'id_kelas_ajaran' => $request->get_kelas,
            'id_mapel' => $request->get_mapel,
            'jam_awal' => $validatehtml['jam_awal'],
            'jam_akhir' => $validatehtml['jam_akhir'],
            'hari' => $request->get_hari,
            'jam_ke' => $validatehtml['jam_ke']
        ])->save();

        Flasher::setFlash('Jadwal Berhasil Ditambahkan', 'success');
        header('Location: ' . base_url . 'jadwal/kelas/' . $request->idKelasAjaran . '/tambah');
        exit();
        // header('Content-Type: application/json');
        // echo json_encode($insert_data, JSON_PRETTY_PRINT);
    }

    public function ubah(Request $request)
    {
        $data['title'] = "Jadwal";
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->first();
        $data['check_kelas'] = Kelas_Ajaran::where('id_kelas_ajaran', $request->idKelasAjaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->first();
        if ($data['check_kelas'] == null) {
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['mapel'] = Mapel::select()->where('status', '1')->all();
        $data['guru'] = Guru::select()->all();
        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/ubah_jadwal',
            'templates/footer',
        ], $data);
        // header('Content-Type: application/json');
        // echo json_encode($data['jadwal'], JSON_PRETTY_PRINT);
    }
    public function update(Request $request, $idKelasAjaran, $idJadwal)
    {
        $insert_data = [
            'id_kelas' => $request->get_kelas,
            'id_mapel' => $request->get_mapel,
            'nuptk' => $request->get_guru,
            'hari' => $request->get_hari,
            'jam_awal' => $request->get_jam_awal,
            'jam_akhir' => $request->get_jam_akhir,
            'get_jam_ke' => $request->get_jam_ke,
        ];
        $rules = [
            'jam_awal' => 'required|max:10',
            'jam_akhir' => 'required|max:10',
            'get_jam_ke' => 'required|max:2',
        ];
        $errors = Validation::make($insert_data, $rules);
        if ($errors) {
            // echo 'ERORR';
            Flasher::setFlash('Gagal Ditambahkan!', 'danger');
            header('Location: ' . base_url . 'jadwal/kelas/' . $idKelasAjaran);
            exit();
        }

        $validatehtml = [
            'jam_awal' => htmlspecialchars($request->get_jam_awal),
            'jam_akhir' => htmlspecialchars($request->get_jam_akhir),
            'jam_ke' => htmlspecialchars($request->get_jam_ke)
        ];
        $jam_keVal = $validatehtml['jam_ke'];
        // echo $jam_keVal;
        if (!is_numeric($jam_keVal)) {
            Flasher::setFlash('Gagal Ditambahkan! Jam Pertemeuan harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'jadwal/tambah');
            exit();
            // echo 'error';
        }

        ModelsJadwal::update([
            'nuptk' => $request->get_guru,
            'id_kelas_ajaran' => $request->get_kelas,
            'id_mapel' => $request->get_mapel,
            'jam_awal' => $validatehtml['jam_awal'],
            'jam_akhir' => $validatehtml['jam_akhir'],
            'hari' => $request->get_hari,
            'jam_ke' => $validatehtml['jam_ke']
        ])->where('tb_jadwal.id_jadwal', $request->idJadwal)->save();
        Flasher::setFlash('Berhasil Diubah', 'success');
        header('Location: ' . base_url . 'jadwal/kelas/' . $request->idKelasAjaran);
        exit();
    }
    public function delete($idkelasAjaran, $idJadwal)
    {
        try {
            ModelsJadwal::where('tb_jadwal.id_jadwal', $idJadwal)->delete()->save();
            // print_r(ModelsJadwal::lastquery());
        } catch (\Throwable $th) {
            echo $th;
        }
        Flasher::setFlash('Berhasil Dihapus', 'success');
        header('Location: ' . base_url . 'jadwal/kelas/' . $idkelasAjaran);
        exit();
    }
}