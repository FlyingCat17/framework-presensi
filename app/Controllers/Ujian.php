<?php

namespace App\Controllers;

use App\Config\Session;
use App\Models\Mapel;
use App\Models\User;
use App\Models\Ujian as ModelsUjian;
use App\Models\Kelas_Ajaran;
use App\Models\Tahun_Ajaran;
use Riyu\Helpers\Errors\AppException;
use Riyu\Http\Request;
use Utils\Flasher;


class Ujian extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
        if (Session::get('type') == "guru") {
            header('Location: ' . base_url . 'g/dashboard');
            exit();
        }
    }
    private function getUser()
    {
        return User::where('id_admin', Session::get('user'))->first();
    }
    public function index()
    {
        $data['title'] = "Ujian";
        $data['admin'] = $this->getUser();
        return view([
            'templates/header',
            'templates/sidebar',
            'ujian/index',
            'templates/footer',
        ], $data);
    }

    public function pilihKelas(Request $request)
    {
        if ($request->jenis > 4) {
            header('Location: ' . base_url . 'ujian');
            exit();
        }
        $tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        $data['title'] = "Jadwal Ujian";
        $data['admin'] = $this->getUser();
        $data['jenis'] = $request->jenis;
        $data['kelas'] = Kelas_Ajaran::where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->all();
        // echo json_encode($data['kelas']);
        return view([
            'templates/header',
            'templates/sidebar',
            'ujian/listKelas',
            'templates/footer',
        ], $data);
    }

    private function getTahunAjaran()
    {
        return Tahun_Ajaran::where('isActive', '1')->first();
    }
    public function tambahJadwal(Request $request)
    {
        if ($request->jenis > 4) {
            header('Location: ' . base_url . 'ujian');
            exit();
        }
        $checkKelas = Kelas_Ajaran::where('tb_kelas_ajaran.id_kelas_ajaran', $request->kelas)
            ->where('id_tahun_ajaran', $this->getTahunAjaran()->id_tahun_ajaran)
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->first();
        if ($checkKelas == false || null) {
            header('Location: ' . base_url . 'ujian/' . $request->jenis);
            exit();
        }
        $data['title'] = "Tambah Jadwal Ujian";
        $data['admin'] = $this->getUser();
        $data['jenis'] = $request->jenis;
        $data['kelas'] = $checkKelas;
        $data['mapel'] = Mapel::where('status', '1')->all();
        return view([
            'templates/header',
            'templates/sidebar',
            'ujian/tambah',
            'templates/footer',
        ], $data);
    }

    public function insertUjian(Request $request)
    {
        if ($request->mapel == "") {
            Flasher::setFlash('Mata Pelajaran kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/tambah/' . $request->kelas);
            exit();
        }
        if ($request->hari == "null") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/tambah/' . $request->kelas);
            exit();
        }
        if ($request->date_start == "") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/tambah/' . $request->kelas);
            exit();
        }
        if ($request->time_start == "null") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/tambah/' . $request->kelas);
            exit();
        }
        $tambah = ModelsUjian::insert([
            'id_mapel' => $request->mapel,
            'id_kelas_ajaran' => $request->kelas,
            'date_ujian' => $request->date_start . ' ' . $request->time_start,
            'jenis_ujian' => $request->jenis,
            'hari' => $request->hari,
        ])->save();

        if ($tambah) {
            Flasher::setFlash('Berhasil Menambahkan Jadwal Ujian!', 'success');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian);
            exit();
        }

        // header('Content-Type: application/json');
        // echo json_encode($request->all(), JSON_PRETTY_PRINT);
    }

    public function ubahJadwal(Request $request)
    {
        $data['title'] = "Ubah Jadwal Ujian";
        $data['admin'] = $this->getUser();
        $data['ujian'] = ModelsUjian::where('id_ujian', $request->id)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_ujian.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->select('*, DATE_FORMAT(tb_ujian.date_ujian, \'%Y-%m-%d\') AS tanggal, DATE_FORMAT(tb_ujian.date_ujian, \'%H:%i\') AS jam')
            ->first();
        $data['mapel'] = Mapel::where('status', '1')->all();
        if ($data['ujian'] == null) {
            header('Location: ' . base_url . 'ujian/' . $request->jenis);
            exit();
        }

        return view([
            'templates/header',
            'templates/sidebar',
            'ujian/edit',
            'templates/footer',
        ], $data);
    }
    public function updateJadwal(Request $request)
    {
        if ($request->mapel == "") {
            Flasher::setFlash('Mata Pelajaran kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/ubah/' . $request->id);
            exit();
        }
        if ($request->hari == "null") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/ubah/' . $request->id);
            exit();
        }
        if ($request->date_start == "") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/ubah/' . $request->id);
            exit();
        }
        if ($request->time_start == "null") {
            Flasher::setFlash('Hari Ujian kosong!', 'danger');
            header('Location: ' . base_url . 'ujian/' . $request->jenis_ujian . '/ubah/' . $request->id);
            exit();
        }
        $ubah = ModelsUjian::update([
            'id_mapel' => $request->mapel,
            'date_ujian' => $request->date_start . ' ' . $request->time_start,
            'jenis_ujian' => $request->jenis,
            'hari' => $request->hari,
        ])
            ->where('tb_ujian.id_ujian', $request->id)
            ->save();

        if ($ubah) {
            Flasher::setFlash('Berhasil Mengubah Jadwal Ujian!', 'success');
            header('Location: ' . base_url . 'ujian/' . $request->jenis);
            exit();
        }
    }

    public function delete(Request $request)
    {
        $hapus = ModelsUjian::where('id_ujian', $request->id)
            ->delete()->save();
        if ($hapus) {
            Flasher::setFlash('Berhasil menghapus Jadwal Ujian!', 'success');
            header('Location: ' . base_url . 'ujian/' . $request->jenis);
            exit();
        }
    }
}
?>