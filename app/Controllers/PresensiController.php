<?php
namespace App\Controllers;

use App\Config\Session;
use App\Controllers\Controller;
use App\Models\Kelas_Ajaran as ModelsKelasAjaran;
use App\Models\Tahun_Ajaran as ModelsTahunAjaran;
use App\Models\Jadwal as ModelsJadwal;
use App\Models\Siswa as ModelsSiswa;
use App\Models\Presensi as ModelsPresensi;
use App\Models\Detail_Presensi as ModelsDetail;
use App\Models\Presensi;
use App\Models\Guru;
use App\Models\User;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class PresensiController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
    }
    public function index(Request $request)
    {

        $data['title'] = 'Presensi';
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->first();
        $data['presensi'] = Presensi::select('id_presensi', 'id_jadwal', 'mulai_presensi', 'akhir_presensi', 'DATE_FORMAT(tb_presensi.mulai_presensi, \'%d %M %Y - %H:%i\', \'id_ID\') AS mulai_presensi_convert', 'DATE_FORMAT(tb_presensi.akhir_presensi, \'%d %M %Y - %H:%i\', \'id_ID\') AS akhir_presensi_convert')
            ->where('tb_presensi.id_jadwal', $data['jadwal']->id_jadwal)
            ->orderBy('tb_presensi.mulai_presensi', 'asc')
            ->all();
        $data['jumlah_siswa'] = ModelsSiswa::select("COUNT(tb_siswa.nis) AS jumlah_siswa")
            ->where('tb_siswa.id_kelas_ajaran', $data['jadwal']->id_kelas_ajaran)
            ->first();

        if ($data['jadwal'] == false || null) {
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
        // header('Content-Type: application/json');
        // echo json_encode(['Jadwal' => $data['jadwal']], JSON_PRETTY_PRINT);
        // $output = json_encode(['Presensi' => $data['presensi']], JSON_PRETTY_PRINT);
        // echo $output;
        // echo json_encode(['jumlah_siswa' => $data['jumlah_siswa']], JSON_PRETTY_PRINT);
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/index',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/index',
                'templates/footer',
            ], $data);
        }
    }

    public function tambah(Request $request)
    {
        $data['title'] = "Presensi";
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->select('*', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir_convert', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal_convert')
            // ->select('DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->first();
        $data['waktu'] = ModelsJadwal::select('DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal')
            ->where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->first();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        if ($data['jadwal'] == false || null) {
            Flasher::setFlash('Tidak Ada Data Presensi!', 'danger');
            header('Location: ' . base_url . 'jadwal');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/tambah',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/tambah',
                'templates/footer',
            ], $data);
        }
    }

    public function insert(Request $request)
    {
        $data_insert = [
            'id_jadwal' => $request->idJadwal,
            'mulai_presensi' => $request->date_start,
            'mulai_jam_presensi' => $request->time_start,
            'akhir_presensi' => $request->date_end,
            'akhir_jam_presensi' => $request->time_end,
        ];

        $rules = [
            'mulai_presensi' => 'required|max:12',
            'akhir_presensi' => 'required|max:12',
            'mulai_jam_presensi' => 'required|max:9',
            'akhir_jam_presensi' => 'required|max:9',
        ];
        $error = Validation::make($data_insert, $rules);
        if ($error) {
            if ($error['mulai_presensi']) {
                Flasher::setFlash('Gagal Ditambahkan! Cek Tanggal Mulai Presensi{required & max:12}', 'danger');
                header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/tambah');
                exit;
            }
            if ($error['akhir_presensi']) {
                Flasher::setFlash('Gagal Ditambahkan! Cek Tanggal Akhir Presensi{required & max:12}', 'danger');
                header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/tambah');
                exit;
            }
            // header('Content-Type: application/json');
            // echo json_encode(['Error' => $error], JSON_PRETTY_PRINT);
            // Flasher::setFlash('Gagal Disimpan', 'danger');
            // exit();
        }

        ModelsPresensi::insert([
            // 'id_presensi' => '',
            'id_jadwal' => $data_insert['id_jadwal'],
            'mulai_presensi' => $data_insert['mulai_presensi'] . ' ' . $data_insert['mulai_jam_presensi'],
            'akhir_presensi' => $data_insert['akhir_presensi'] . ' ' . $data_insert['akhir_jam_presensi']
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan!', 'success');
        header('Location: ' . base_url . 'presensi/' . $data_insert['id_jadwal']);
        exit();
    }

    public function ubah(Request $request)
    {
        // var_dump($request->idJadwal);
        // var_dump($request->idPresensi);
        $data['title'] = "Presensi";
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->select('*', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir_convert', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal_convert')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->first();
        $data['presensi'] = ModelsPresensi::where('tb_presensi.id_presensi', $request->idPresensi)
            ->where('tb_presensi.id_jadwal', $data['jadwal']->id_jadwal)
            ->select('id_presensi', 'id_jadwal', 'DATE_FORMAT(tb_presensi.mulai_presensi, \'%H:%i\') AS jam_awal_presensi', 'DATE_FORMAT(tb_presensi.akhir_presensi, \'%H:%i\') AS jam_akhir_presensi', 'DATE_FORMAT(tb_presensi.mulai_presensi, \'%Y-%m-%d\') AS tgl_awal_presensi', 'DATE_FORMAT(tb_presensi.akhir_presensi, \'%Y-%m-%d\') AS tgl_akhir_presensi')
            ->first();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        // header('Content-Type: application/json');
        // echo json_encode(['Presensi' => $data['presensi']], JSON_PRETTY_PRINT);
        if ($data['presensi'] == false || null) {
            header('Content-Type: application/json');
            echo json_encode('ERROR', JSON_PRETTY_PRINT);
            exit();
        }
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/ubah',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/ubah',
                'templates/footer',
            ], $data);
        }
    }
    public function update(Request $request)
    {
        $data_insert = [
            'id_jadwal' => $request->idJadwal,
            'mulai_presensi' => $request->date_start,
            'mulai_jam_presensi' => $request->time_start,
            'akhir_presensi' => $request->date_end,
            'akhir_jam_presensi' => $request->time_end,
        ];

        $rules = [
            'mulai_presensi' => 'required|max:12',
            'akhir_presensi' => 'required|max:12',
            'mulai_jam_presensi' => 'required|max:9',
            'akhir_jam_presensi' => 'required|max:9',
        ];
        $error = Validation::make($data_insert, $rules);
        if ($error) {
            if ($error['mulai_presensi']) {
                Flasher::setFlash('Gagal Ditambahkan! Cek Tanggal Mulai Presensi{required & max:12}', 'danger');
                header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/tambah');
                exit;
            }
            if ($error['akhir_presensi']) {
                Flasher::setFlash('Gagal Ditambahkan! Cek Tanggal Akhir Presensi{required & max:12}', 'danger');
                header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/tambah');
                exit;
            }
            // Flasher::setFlash('Gagal Disimpan', 'danger');
            // exit();
        }
        ModelsPresensi::update([
            'mulai_presensi' => $data_insert['mulai_presensi'] . ' ' . $data_insert['mulai_jam_presensi'],
            'akhir_presensi' => $data_insert['akhir_presensi'] . ' ' . $data_insert['akhir_jam_presensi']
        ])->where('tb_presensi.id_presensi', $request->idPresensi)->save();
        Flasher::setFlash('Presensi Berhasil Diubah', 'success');
        header('Location: ' . base_url . 'presensi/' . $request->idJadwal);
        exit();
        // header('Content-Type: application/json');
        // echo json_encode(['Update' => $update], JSON_PRETTY_PRINT);
    }
    public function delete(Request $request)
    {
        ModelsPresensi::where('id_presensi', $request->idPresensi)->delete()->save();
        Flasher::setFlash('Berhasil Dihapus', 'success');
        header('Location: ' . base_url . 'presensi/' . $request->idJadwal);
        exit();
    }

    public function detail(Request $request)
    {
        $data['title'] = "Presensi";
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->select('*', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir_convert', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal_convert')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->first();
        if ($data['jadwal'] == false || null) {
            echo 'Tidak Ada Jadwal';
            exit();
        }
        $data['presensi'] = ModelsPresensi::where('tb_presensi.id_presensi', $request->idPresensi)
            ->where('tb_presensi.id_jadwal', $data['jadwal']->id_jadwal)
            ->select('id_presensi', 'id_jadwal', 'DATE_FORMAT(tb_presensi.mulai_presensi, \'%H:%i\') AS jam_awal_presensi', 'DATE_FORMAT(tb_presensi.akhir_presensi, \'%H:%i\') AS jam_akhir_presensi', 'DATE_FORMAT(tb_presensi.mulai_presensi, \'%d-%M-%Y\', \'id_ID\') AS tgl_awal_presensi', 'DATE_FORMAT(tb_presensi.akhir_presensi, \'%d-%M-%Y\', \'id_ID\') AS tgl_akhir_presensi')
            ->first();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        if ($data['presensi'] == false || null) {
            // echo 'Tidak Ada Presensi';/
            header('Location: ' . base_url . 'presensi/' . $request->idJadwal);
            exit();
        }
        $data['detail_presensi'] = ModelsDetail::leftjoin('tb_siswa', 'tb_siswa.nis', '=', 'tb_detail_presensi.nis')
            ->where('tb_detail_presensi.id_presensi', $data['presensi']->id_presensi)
            ->all();
        $data['siswa'] = ModelsSiswa::where('id_kelas_ajaran', $data['jadwal']->id_kelas_ajaran)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->select('tb_siswa.nis', 'tb_siswa.nama_siswa')
            ->all();


        // header('Content-Type: application/json');
        foreach ($data['siswa'] as $siswa) {
            // echo json_encode(['nis' => $siswa['nis']], JSON_PRETTY_PRINT);
            // $data['check'] = ModelsDetail::select('kehadiran')
            //     ->where('tb_detail_presensi.nis', $siswa['nis'])
            //     ->where('tb_detail_presensi.id_presensi', $data['presensi']->id_presensi)
            //     ->all();
            // if ($data['check'] > 0) {
            //     // echo json_encode($check['keha']);
            //     foreach ($data['check'] as $checks) {
            //         echo json_encode($checks['kehadiran']);
            //     }
            // }

            // echo json_encode([
            //     'nis' => $siswa['nis'],
            //     'nama' => $siswa['nama_siswa'],
            //     'Kehadiran' => $check
            // ], JSON_PRETTY_PRINT);
            // $data['kehadiran'] = [
            //     $siswa['nis'], $siswa['nama_siswa'],
            //     $data['check']
            // ];
            // echo json_encode($data['kehadiran']);
        }
        // header('Content-Type: application/json');
        // echo json_encode($data['presensi'], JSON_PRETTY_PRINT);
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/detail',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/detail',
                'templates/footer',
            ], $data);
        }
    }
    public function tambah_presensi(Request $request)
    {
        if (isset($request->kehadiran)) {
            $kehadiran = $request->kehadiran;
            switch ($kehadiran) {
                case '1':
                    // echo 'Hadir';
                    $date2 = date('Y-m-d H:i:s', time());
                    // echo $date2;
                    ModelsDetail::insert([
                        'id_presensi' => $request->idPresensi,
                        'nis' => $request->nis,
                        'timestamp' => $date2,
                        'kehadiran' => $request->kehadiran
                    ])->save();
                    // echo 'Berhasil Presensi Siswa';
                    Flasher::setFlash('Berhasil Presensi Siswa', 'success');
                    header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
                    break;
                case '2':
                    //UPLOAD GAMBAR/FILE
                    $namaFile = $request->file['name'];
                    $sizeFile = $request->file['size'];
                    $error = $request->file['error'];
                    $tmpName = $request->file['tmp_name'];

                    if ($request->file['error'] === 4) {
                        Flasher::setFlash('Wajib mengupload bukti izin', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }
                    //get ekstension from file
                    $ekstensi = ['jpg', 'jpeg', 'png', 'pdf'];
                    $ekstensiFile = pathinfo($request->file['name'], PATHINFO_EXTENSION);
                    if (!in_array($ekstensiFile, $ekstensi)) {
                        Flasher::setFlash('File yang diperbolehkan upload: \'jpg\', \'png\', \'jpeg\'', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }

                    //get size of file
                    if ($sizeFile > 5242880) {
                        Flasher::setFlash('File terlalu besar! Maksimal 5 MB', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }
                    date_default_timezone_set('Asia/Jakarta');
                    date_default_timezone_get();
                    $date = date('Ymd_His', time());
                    $date2 = date('Y-m-d H:i:s', time());
                    $formatFile = $request->nis . '_' . $kehadiran . '_' . $date . '_' . $request->idPresensi . '.' . $ekstensiFile;
                    // echo $formatFile;
                    // $moveFile = __DIR__ . $formatFile;
                    $moveFile = __DIR__ . "/../../images/bukti_izin/" . $formatFile;
                    // echo $moveFile;
                    // $this->compress($tmpName, $moveFile, 75);
                    if (move_uploaded_file($tmpName, $moveFile)) {
                        ModelsDetail::insert([
                            'id_presensi' => $request->idPresensi,
                            'nis' => $request->nis,
                            'timestamp' => $date2,
                            'kehadiran' => $request->kehadiran,
                            'bukti_izin' => "images/bukti_izin/" . $formatFile
                        ])->save();
                        Flasher::setFlash('Berhasil Presensi Siswa', 'info');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
                        exit();
                    }
                    break;
                case '3':
                    //UPLOAD GAMBAR/FILE
                    $namaFile = $request->file['name'];
                    $sizeFile = $request->file['size'];
                    $error = $request->file['error'];
                    $tmpName = $request->file['tmp_name'];

                    if ($request->file['error'] === 4) {
                        Flasher::setFlash('Wajib mengupload bukti izin', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }
                    //get ekstension from file
                    $ekstensi = ['jpg', 'jpeg', 'png', 'pdf'];
                    $ekstensiFile = pathinfo($request->file['name'], PATHINFO_EXTENSION);
                    if (!in_array($ekstensiFile, $ekstensi)) {
                        Flasher::setFlash('File yang diperbolehkan upload: \'jpg\', \'png\', \'jpeg\'', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }

                    //get size of file
                    if ($sizeFile > 5242880) {
                        Flasher::setFlash('File terlalu besar! Maksimal 5 MB', 'danger');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                        exit();
                    }
                    date_default_timezone_set('Asia/Jakarta');
                    date_default_timezone_get();
                    $date = date('Ymd_His', time());
                    $date2 = date('Y-m-d H:i:s', time());
                    $formatFile = $request->nis . '_' . $kehadiran . '_' . $date . '_' . $request->idPresensi . '.' . $ekstensiFile;
                    // echo $formatFile;
                    // $moveFile = __DIR__ . $formatFile;
                    $moveFile = __DIR__ . "/../../images/bukti_izin/" . $formatFile;
                    // echo $moveFile;
                    // $this->compress($tmpName, $moveFile, 75);
                    if (move_uploaded_file($tmpName, $moveFile)) {
                        ModelsDetail::insert([
                            'id_presensi' => $request->idPresensi,
                            'nis' => $request->nis,
                            'timestamp' => $date2,
                            'kehadiran' => $request->kehadiran,
                            'bukti_izin' => "images/bukti_izin/" . $formatFile
                        ])->save();
                        Flasher::setFlash('Berhasil Presensi Siswa', 'info');
                        header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
                        exit();
                    }
                    break;
                default:
                    Flasher::setFlash('Harap Pilih Kehadiran!', 'danger');
                    header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi . '/tambah/' . $request->nis);
                    break;
            }
        }
    }


    public function tambahSiswaPresensi(Request $request)
    {
        // header('Content-Type: application/json');
        $data['title'] = "Tambah Presensi Siswa";
        $data['jadwal'] = ModelsJadwal::where('id_jadwal', $request->idJadwal)->first();
        $data['siswa'] = ModelsSiswa::where('tb_siswa.nis', $request->nis)
            ->where('tb_siswa.id_kelas_ajaran', $data['jadwal']->id_kelas_ajaran)
            ->join('tb_jadwal', 'tb_jadwal.id_kelas_ajaran', 'tb_siswa.id_kelas_ajaran')
            ->first();
        $data['presensi'] = ModelsPresensi::where('id_presensi', $request->idPresensi)->first();
        $data['detailPresensi'] = ModelsDetail::where('tb_detail_presensi.id_presensi', $request->idPresensi)
            ->where('tb_detail_presensi.nis', $request->nis)
            ->first();
        if ($data['siswa'] == false || null) {
            header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
            exit();
        }
        if ($data['detailPresensi'] != false) {
            Flasher::setFlash('Sudah Melakukan Presensi!', 'info');
            header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        // echo json_encode($data['siswa'], JSON_PRETTY_PRINT);
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/detail/tambah',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/detail/tambah',
                'templates/footer',
            ], $data);
        }
    }

    public function detailSiswaPresensi(Request $request, $idDetail, $idPresensi, $idJadwal)
    {
        $data['title'] = 'Detail Presensi';
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['detail'] = ModelsDetail::where('id_detail_presensi', $idDetail)
            ->where('tb_detail_presensi.id_presensi', $idPresensi)
            ->where('tb_presensi.id_jadwal', $idJadwal)
            ->join('tb_presensi', 'tb_presensi.id_presensi', $idPresensi)
            ->select('*, DATE_FORMAT(tb_detail_presensi.timestamp, \'%d %M %Y - %H:%i\', \'id_ID\') AS timestamp')
            ->first();
        $data['siswa'] = ModelsSiswa::where('nis', $data['detail']->nis)->first();

        // header('Content-Type: application/json');    
        if ($data['detail'] == false || null) {
            header('Location: ' . base_url . 'presensi/' . $request->idJadwal . '/detail/' . $request->idPresensi);
            exit();
        }
        // echo json_encode(['Detail' => $data['detail']], JSON_PRETTY_PRINT);
        // echo ($idPresensi);
        if (Session::get('type') == 'guru') {
            $data['guru'] = $this->getGuru();
            return view([
                'guru/view/templates/header',
                'guru/view/templates/sidebar',
                'presensi/detail/index',
                'guru/view/templates/footer',
            ], $data);
        } else {
            return view([
                'templates/header',
                'templates/sidebar',
                'presensi/detail/index',
                'templates/footer',
            ], $data);
        }
    }
    public function rekapPresensi(Request $request)
    {
        $data['title'] = "Rekap Presensi";
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['jadwal'] = ModelsJadwal::where('tb_jadwal.id_jadwal', $request->idJadwal)
            ->select('*', 'DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') AS jam_akhir_convert', 'DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') AS jam_awal_convert')
            ->where('tb_kelas_ajaran.id_tahun_ajaran', $data['tahun_ajaran']->id_tahun_ajaran)
            ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
            ->join('tb_guru', 'tb_guru.nuptk', 'tb_jadwal.nuptk')
            ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
            ->first();
        $data['siswa'] = ModelsSiswa::where('id_kelas_ajaran', $data['jadwal']->id_kelas_ajaran)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->select('tb_siswa.nis', 'tb_siswa.nama_siswa')
            ->all();
        $data['presensi'] = ModelsPresensi::where('tb_presensi.id_jadwal', $data['jadwal']->id_jadwal)
            ->select('tb_presensi.id_presensi')
            ->orderBy('tb_presensi.mulai_presensi', 'ASC')
            ->all();
        return view([
            'presensi/rekap/index'
        ], $data);
    }

    private function getGuru()
    {
        return Guru::where('nuptk', Session::get('user'))->first();
    }
}