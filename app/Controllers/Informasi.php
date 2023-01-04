<?php

namespace App\Controllers;

use App\Config\Session;
use App\Models\Informasi as ModelsInformasi;
use App\Models\User;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class Informasi extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
    }
    private function getUser()
    {
        return User::where('id_admin', Session::get('user'))->first();
    }
    public function index(Request $request)
    {
        $data['title'] = "Informasi Akademik";
        $data['admin'] = $this->getUser();
        $data['jumlah_data'] = ModelsInformasi::select()->count();
        $data['informasi'] = ModelsInformasi::orderby('id_informasi', 'desc')->select('*, DATE_FORMAT(tb_informasi.created_at, \'%d %M %Y\') AS tanggal')->paginate($request->page);
        $data['halaman_aktif'] = $request->page;
        $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
        $data['halaman_akhir'] = $data['jumlah_halaman'];
        return view([
            'templates/header',
            'templates/sidebar',
            'informasi/index',
            'templates/footer',
        ], $data);
    }

    public function detail(Request $request)
    {
        if ($request->id == "") {
            header('Location: ' . base_url . 'informasi');
            exit();
        }
        $data['admin'] = $this->getUser();
        $data['title'] = "Detail Informasi";
        $data['informasi'] = ModelsInformasi::where('id_informasi', $request->id)->first();
        // header('Content-Type: application/json');
        // echo json_encode($data['informasi'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'informasi/detail',
            'templates/footer',
        ], $data);
    }

    public function tambah()
    {
        if (isset($_SESSION['informasi'])) {
            $data['isi'] = $_SESSION['informasi']['isi'];
            $data['judul'] = $_SESSION['informasi']['judul'];
            unset($_SESSION['informasi']);
        }
        $data['title'] = "Tambah Informasi";
        $data['admin'] = $this->getUser();
        return view([
            'templates/header',
            'templates/sidebar',
            'informasi/tambah',
            'templates/footer',
        ], $data);
    }

    public function insert(Request $request)
    {
        $date_1 = date('Y-m-d', time());
        $get = [
            'Data' => $request->all(),
            'Date' => $date_1
        ];
        $rule = [
            'judul' => 'required|max:100|min:5',
            'isi' => 'required|max:1000'
        ];
        $message = [
            'required' => ':field tidak boleh kosong!',
            'max' => ':field maksimal :max karakter!',
            'min' => ':field minimal :min karakter!',
        ];
        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);
        unset($_SESSION['informasi']);
        if ($errors) {
            Flasher::setFlash('Data Gagal di Simpan! error: ' . $errors, 'danger');
            $_SESSION['informasi']['isi'] = $get['Data']['isi'];
            $_SESSION['informasi']['judul'] = $get['Data']['judul'];
            header('Location: ' . base_url . 'informasi/tambah');
            exit();
        }

        $val_char = [
            'judul' => htmlspecialchars($get['Data']['judul']),
            'isi' => htmlspecialchars($get['Data']['isi']),
        ];
        // header('Content-Type: application/json');
        switch ($get['Data']['thumbnail']['error']) {
            case '4':
                try {
                    $insert = ModelsInformasi::insert([
                        'judul_informasi' => $val_char['judul'],
                        'isi_informasi' => $val_char['isi'],
                        'created_at' => $get['Date']
                    ])->save();
                    if ($insert) {
                        Flasher::setFlash('Berhasil Menambahkan Data Informasi', 'success');
                        header('Location: ' . base_url . 'informasi');
                        exit();
                    } else {
                        Flasher::setFlash('Gagal Menambahkan Data Informasi', 'danger');
                        header('Location: ' . base_url . 'informasi');
                        exit();

                    }
                } catch (\Throwable $th) {
                    throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
                }
                break;
            case '0':
                $namaFile = $get['Data']['thumbnail']['name'];
                $sizeFile = $get['Data']['thumbnail']['size'];
                $error = $get['Data']['thumbnail']['error'];
                $tmpName = $get['Data']['thumbnail']['tmp_name'];

                $ekstensi = ['jpg', 'png', 'jpeg'];
                $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

                if (!in_array($ekstensiFile, $ekstensi)) {
                    Flasher::setFlash('Gagal Upload! Ekstensi foto yang diperbolehkan : \'jpg\', \'png\', \'jpeg\'', 'danger');
                    $_SESSION['informasi']['isi'] = $get['Data']['isi'];
                    $_SESSION['informasi']['judul'] = $get['Data']['judul'];
                    header('Location: ' . base_url . 'informasi/tambah');
                    exit();
                }

                if ($sizeFile > 5242880) {
                    Flasher::setFlash('Gagal Upload! Ukuran foto terlalu besar! Maksimal 5 MB', 'danger');
                    $_SESSION['informasi']['isi'] = $get['Data']['isi'];
                    $_SESSION['informasi']['judul'] = $get['Data']['judul'];
                    header('Location: ' . base_url . 'informasi/tambah');
                    exit();
                }
                $format_tgl = date('Ymd-His', time());
                $formatFile = 'thumbnail-' . $format_tgl . '.' . $ekstensiFile;
                $moveFile = __DIR__ . "/../../images/informasi/thumb/" . $formatFile;
                if (move_uploaded_file($tmpName, $moveFile)) {
                    try {
                        $insert = ModelsInformasi::insert([
                            'judul_informasi' => $val_char['judul'],
                            'isi_informasi' => $val_char['isi'],
                            'created_at' => $get['Date'],
                            'thumbnail' => $formatFile
                        ])->save();
                        if ($insert) {
                            Flasher::setFlash('Berhasil Menambahkan Data Informasi', 'success');
                            header('Location: ' . base_url . 'informasi');
                            exit();
                        } else {
                            Flasher::setFlash('Gagal Menambahkan Data Informasi', 'danger');
                            header('Location: ' . base_url . 'informasi');
                            exit();

                        }
                    } catch (\Throwable $th) {
                        throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
                    }
                }
                break;
            default:
                break;
        }
        // echo json_encode($get, JSON_PRETTY_PRINT);
        // print_r($get['Data']['thumbnail']['error']);
    }

    public function ubah(Request $request)
    {
        $check = ModelsInformasi::where('id_informasi', $request->id)->first();
        if ($check == false || "") {
            header('Location: ' . base_url . 'informasi');
            exit();
        }

        $data['title'] = "Ubah Informasi";
        $data['admin'] = $this->getUser();
        $data['informasi'] = $check;
        return view([
            'templates/header',
            'templates/sidebar',
            'informasi/edit',
            'templates/footer',
        ], $data);
    }

    public function update(Request $request)
    {
        $check = ModelsInformasi::where('id_informasi', $request->id)->first();
        if ($check == false || "") {
            header('Location: ' . base_url . 'informasi');
            exit();
        }
        $date_1 = date('Y-m-d', time());
        $get = [
            'Data' => $request->all(),
            'Date' => $date_1
        ];
        $rule = [
            'judul' => 'required|max:100|min:5',
            'isi' => 'required|max:1000'
        ];
        $message = [
            'required' => ':field tidak boleh kosong!',
            'max' => ':field maksimal :max karakter!',
            'min' => ':field minimal :min karakter!',
        ];
        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);
        unset($_SESSION['informasi']);
        if ($errors) {
            Flasher::setFlash('Data Gagal di Simpan! error: ' . $errors, 'danger');
            $_SESSION['informasi']['isi'] = $get['Data']['isi'];
            $_SESSION['informasi']['judul'] = $get['Data']['judul'];
            header('Location: ' . base_url . 'informasi/ubah/' . $request->id);
            exit();
        }

        $val_char = [
            'judul' => htmlspecialchars($get['Data']['judul']),
            'isi' => htmlspecialchars($get['Data']['isi']),
        ];
        // header('Content-Type: application/json');
        switch ($get['Data']['thumbnail']['error']) {
            case '4':
                try {
                    $insert = ModelsInformasi::update([
                        'judul_informasi' => $val_char['judul'],
                        'isi_informasi' => $val_char['isi'],
                        // 'created_at' => $get['Date']
                    ])->where('id_informasi', $request->id)->save();
                    if ($insert) {
                        Flasher::setFlash('Berhasil Mengubah Data Informasi', 'success');
                        header('Location: ' . base_url . 'informasi');
                        exit();
                    } else {
                        Flasher::setFlash('Gagal Mengubah Data Informasi', 'danger');
                        header('Location: ' . base_url . 'informasi');
                        exit();

                    }
                } catch (\Throwable $th) {
                    throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
                }
                break;
            case '0':
                // echo $check->thumbnail;
                // exit();
                $namaFile = $get['Data']['thumbnail']['name'];
                $sizeFile = $get['Data']['thumbnail']['size'];
                $error = $get['Data']['thumbnail']['error'];
                $tmpName = $get['Data']['thumbnail']['tmp_name'];

                $ekstensi = ['jpg', 'png', 'jpeg'];
                $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

                if (!in_array($ekstensiFile, $ekstensi)) {
                    Flasher::setFlash('Gagal Upload! Ekstensi foto yang diperbolehkan : \'jpg\', \'png\', \'jpeg\'', 'danger');
                    $_SESSION['informasi']['isi'] = $get['Data']['isi'];
                    $_SESSION['informasi']['judul'] = $get['Data']['judul'];
                    header('Location: ' . base_url . 'informasi/tambah');
                    exit();
                }

                if ($sizeFile > 5242880) {
                    Flasher::setFlash('Gagal Upload! Ukuran foto terlalu besar! Maksimal 5 MB', 'danger');
                    $_SESSION['informasi']['isi'] = $get['Data']['isi'];
                    $_SESSION['informasi']['judul'] = $get['Data']['judul'];
                    header('Location: ' . base_url . 'informasi/tambah');
                    exit();
                }
                $format_tgl = date('Ymd-Hi', time());
                unlink(__DIR__ . "/../../images/informasi/thumb/" . $check->thumbnail);
                $formatFile = 'thumbnail-' . $format_tgl . '.' . $ekstensiFile;
                $moveFile = __DIR__ . "/../../images/informasi/thumb/" . $formatFile;
                if (move_uploaded_file($tmpName, $moveFile)) {
                    try {
                        $ubah = ModelsInformasi::update([
                            'judul_informasi' => $val_char['judul'],
                            'isi_informasi' => $val_char['isi'],
                            'thumbnail' => $formatFile
                        ])->where('id_informasi', $request->id)->save();
                        if ($ubah) {
                            Flasher::setFlash('Berhasil Mengubah Data Informasi', 'success');
                            header('Location: ' . base_url . 'informasi');
                            exit();
                        } else {
                            Flasher::setFlash('Gagal Mengubah Data Informasi', 'danger');
                            header('Location: ' . base_url . 'informasi');
                            exit();

                        }
                    } catch (\Throwable $th) {
                        throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
                    }
                }
                break;
            default:
                break;
        }
    }

    public function delete(Request $request)
    {
        $check = ModelsInformasi::where('id_informasi', $request->id)->first();
        if ($check == false || "") {
            header('Location: ' . base_url . 'informasi');
            exit();
        }

        $hapus = ModelsInformasi::delete()->where('id_informasi', $check->id_informasi)->save();
        Flasher::setFlash('Berhasil Menghapus <strong>' . $check->judul_informasi . '</strong>', 'success');
        header('Location: ' . base_url . 'informasi');
        exit();
    }

    public function cari(Request $request)
    {
        if ($request->q == null || "") {
            Flasher::setFlash('Masukkan keyword pencarian!', 'danger');
            header("Location: " . base_url . 'informasi/page/1');
            exit();
        }
        $data['title'] = 'Hasil Pencarian Informasi';
        try {
            $keyword = $request->q;
            $data['keyword'] = $keyword;
            $data['jumlah_data'] = ModelsInformasi::where('judul_informasi', 'LIKE', '%' . $keyword . '%')
                ->count();
            $data['informasi'] = ModelsInformasi::where('judul_informasi', 'LIKE', '%' . $keyword . '%')
                ->orderby('judul_informasi', 'asc')->paginate($request->page);
            $data['admin'] = User::where('id_admin', Session::get('user'))->first();
            $data['halaman_aktif'] = $request->page;
            $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
            $data['halaman_akhir'] = $data['jumlah_halaman'];
            return view(['templates/header', 'templates/sidebar', 'informasi/cari/index', 'templates/footer'], $data);
        } catch (\Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }

        // $data['data_siswa'] = ModelsSiswa::where('status', '1')
        //     ->where('nama_siswa', 'LIKE', '%' . $request->keyword . '%')
        //     ->orWhere('nis', 'LIKE', '%' . $request->keyword . '%')
        //     ->orderby('nama_siswa', 'asc')->all();
        // $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        // return view(['templates/header', 'templates/sidebar', 'siswa/index', 'templates/footer'], $data);
    }

    public function search(Request $request)
    {
        // print_r($request->all());
        if (!isset($request->page)) {
            $keyword = $request->keyword;
            header('Location: ' . base_url . 'informasi/cari?q=' . $keyword . '&page=1');
            exit();
        } else {
            $this->cari($request);
        }
    }
}