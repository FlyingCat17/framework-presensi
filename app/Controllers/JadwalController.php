<?php
namespace App\Controllers;

use App\Config\Controller;
use App\Models\Jadwal as ModelsJadwal;
use App\Models\Tahun_Ajaran;
use App\Models\Kelas_Ajaran;
use App\Models\Mapel;
use App\Models\Guru;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class JadwalController extends Controller
{
    public function index()
    {
        $data['title'] = "Jadwal";
        $id_tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $id_tahun_ajaran->id_tahun_ajaran)
            ->orderBy('tb_jadwal.hari', 'asc')
            ->orderBy('tb_jadwal.jam_awal', 'asc')
            ->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['jadwal'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'jadwal/index',
            'templates/footer',
        ], $data);
        // echo 'jadwal/index';
    }

    public function tambah()
    {
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
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
            header('Location: ' . base_url . 'jadwal/tambah');
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
        header('Location: ' . base_url . 'jadwal/tambah');
        exit();
        // header('Content-Type: application/json');
        // echo json_encode($insert_data, JSON_PRETTY_PRINT);
    }

    public function ubah(Request $request, $id)
    {
        $data['title'] = "Jadwal";
        $data['tahun_ajaran'] = Tahun_Ajaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::select('tb_jadwal.id_jadwal', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_guru.nama_guru', 'tb_jadwal.hari', 'tb_jadwal.jam_ke', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'tb_jadwal.nuptk', 'tb_jadwal.id_mapel', 'tb_jadwal.id_kelas_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->where('tb_jadwal.id_jadwal', $id)
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->first();
        $data['kelas'] = Kelas_Ajaran::where('id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->all();
        $data['mapel'] = Mapel::select()->all();
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
}