<?php

namespace App\Controllers;

use App\Models\Guru as ModelsGuru;
use App\Models\User;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use App\Controllers\Controller;
use App\Config\Session;
use Utils\Flasher;
use Riyu\Validation\Validation;

class Guru extends Controller
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
        $data['title'] = "Guru";
        $data['guru'] = ModelsGuru::where('isActive', '1')->all();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'guru/index', 'templates/footer'], $data);

    }

    public function tambah()
    {
        $data['title'] = "Guru";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'guru/tambah', 'templates/footer'], $data);
    }

    public function insert(Request $request)
    {
        $check = ModelsGuru::where('nuptk', $request->nuptk)->first();
        if ($check) {
            $val = Validation::make(
                $request->all(),
                [
                    'nuptk' => 'required|max:25',
                    'nama' => 'required|max:128',
                    'tempat_lahir' => 'required|max:128',
                    'tgl_lahir' => 'required|max:15',
                    'alamat' => 'required|max:255',
                    'telepon' => 'required|max:15',
                    'status' => 'required|max:20'
                ]
            );
            if ($val) {
                // header('Content-Type: application/json');
                // echo json_encode($val, JSON_PRETTY_PRINT);
                if (isset($val['nuptk'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek NUPTK {maksimal: 25 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['nama'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek Nama {maksimal: 128 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['tempat_lahir'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek Tempat Lahir {maksimal: 128 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['tgl_lahir'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek Tanggal Lahir {maksimal: 15 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['alamat'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek Alamat {maksimal: 255 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['telepon'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek NUPTK {maksimal: 15 digit}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                if (isset($val['status'])) {
                    Flasher::setFlash('Data Gagal Ditambahkan! Cek Status {maksimal: 20 karakter}', 'danger');
                    header('Location: ' . base_url . 'guru/tambah');
                    exit();
                }
                // echo 'SOMETHING WRONG';
            }
            $val_char = [
                'nuptk' => htmlspecialchars($request->nuptk),
                'nama' => htmlspecialchars($request->nama),
                'tempat_lahir' => htmlspecialchars($request->tempat_lahir),
                'tgl_lahir' => htmlspecialchars($request->tgl_lahir),
                'alamat' => htmlspecialchars($request->alamat),
                'telepon' => htmlspecialchars($request->telepon),
                'status' => htmlspecialchars($request->status)
            ];
            $phone = $val_char['telepon'];
            // echo $phone;
            if (!is_numeric($phone)) {
                Flasher::setFlash('Gagal Ditambahkan! Nomor Telepon harus berisikan angka!', 'danger');
                header('location: ' . base_url . 'guru/tambah');
                exit();
            }
            ModelsGuru::update([
                'nuptk' => $val_char['nuptk'],
                'nama_guru' => $val_char['nama'],
                'tempat_lahir' => $val_char['tempat_lahir'],
                'tanggal_lahir' => $val_char['tgl_lahir'],
                'alamat_guru' => $val_char['alamat'],
                'notelp_guru' => $val_char['telepon'],
                'status_kepegawaian' => $val_char['status'],
                'isActive' => '1'
            ])->where('nuptk', $request->nuptk)->save();
            Flasher::setFlash('Berhasil Diubah!', 'success');
            header('location: ' . base_url . 'guru/tambah');
            exit();
        }

        $val = Validation::make(
            $request->all(),
            [
                'nuptk' => 'required|max:25',
                'nama' => 'required|max:128',
                'tempat_lahir' => 'required|max:128',
                'tgl_lahir' => 'required|max:15',
                'alamat' => 'required|max:255',
                'telepon' => 'required|max:15',
                'status' => 'required|max:20'
            ]
        );
        if ($val) {
            // header('Content-Type: application/json');
            // echo json_encode($val, JSON_PRETTY_PRINT);
            if (isset($val['nuptk'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek NUPTK {maksimal: 25 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['nama'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek Nama {maksimal: 128 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['tempat_lahir'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek Tempat Lahir {maksimal: 128 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['tgl_lahir'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek Tanggal Lahir {maksimal: 15 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['alamat'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek Alamat {maksimal: 255 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['telepon'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek NUPTK {maksimal: 15 digit}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            if (isset($val['status'])) {
                Flasher::setFlash('Data Gagal Ditambahkan! Cek Status {maksimal: 20 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/tambah');
                exit();
            }
            // echo 'SOMETHING WRONG';
        }
        $val_char = [
            'nuptk' => htmlspecialchars($request->nuptk),
            'nama' => htmlspecialchars($request->nama),
            'tempat_lahir' => htmlspecialchars($request->tempat_lahir),
            'tgl_lahir' => htmlspecialchars($request->tgl_lahir),
            'alamat' => htmlspecialchars($request->alamat),
            'telepon' => htmlspecialchars($request->telepon),
            'status' => htmlspecialchars($request->status)
        ];
        $phone = $val_char['telepon'];
        // echo $phone;
        if (!is_numeric($phone)) {
            Flasher::setFlash('Gagal Ditambahkan! Nomor Telepon harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'guru/tambah');
            exit();
        }
        ModelsGuru::insert([
            'nuptk' => $val_char['nuptk'],
            'nama_guru' => $val_char['nama'],
            'tempat_lahir' => $val_char['tempat_lahir'],
            'tanggal_lahir' => $val_char['tgl_lahir'],
            'alamat_guru' => $val_char['alamat'],
            'notelp_guru' => $val_char['telepon'],
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'status_kepegawaian' => $val_char['status'],
            'isActive' => '1'
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan! Password default = 123456', 'success');
        header('location: ' . base_url . 'guru/tambah');
        exit();
    }


    public function ubah(Request $request)
    {
        $data['guru'] = ModelsGuru::where('nuptk', $request->nuptk)->first();

        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        if (!$data['guru']) {
            header('location: ' . base_url . 'guru');
            exit();
        }
        $data['title'] = "Guru";
        return view(['templates/header', 'templates/sidebar', 'guru/edit', 'templates/footer'], $data);
    }

    public function update(Request $request)
    {
        $val = Validation::make(
            $request->all(),
            [
                'nuptk' => 'required|max:25',
                'nama' => 'required|max:128',
                'tempat_lahir' => 'required|max:128',
                'tgl_lahir' => 'required|max:15',
                'alamat' => 'required|max:255',
                'telepon' => 'required|max:15',
                'status' => 'required|max:20'
            ]
        );
        if ($val) {
            // header('Content-Type: application/json');
            // echo json_encode($val, JSON_PRETTY_PRINT);
            if (isset($val['nuptk'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek NUPTK {maksimal: 25 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['nama'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Nama {maksimal: 128 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['tempat_lahir'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Tempat Lahir {maksimal: 128 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['tgl_lahir'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Tanggal Lahir {maksimal: 15 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['alamat'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Alamat {maksimal: 255 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['telepon'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Telepon {maksimal: 15 digit}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            if (isset($val['status'])) {
                Flasher::setFlash('Data Gagal Diubah! Cek Status {maksimal: 20 karakter}', 'danger');
                header('Location: ' . base_url . 'guru/ubah/' . $request->nuptk);
                exit();
            }
            // echo 'SOMETHING WRONG';
        }
        $val_char = [
            'nuptk' => htmlspecialchars($request->nuptk),
            'nama' => htmlspecialchars($request->nama),
            'tempat_lahir' => htmlspecialchars($request->tempat_lahir),
            'tgl_lahir' => htmlspecialchars($request->tgl_lahir),
            'alamat' => htmlspecialchars($request->alamat),
            'telepon' => htmlspecialchars($request->telepon),
            'status' => htmlspecialchars($request->status)
        ];
        $phone = $val_char['telepon'];
        // echo $phone;
        if (!is_numeric($phone)) {
            Flasher::setFlash('Gagal Diubah! Nomor Telepon harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'guru/ubah/' . $request->nuptk);
            exit();
        }
        ModelsGuru::update([
            'nuptk' => $val_char['nuptk'],
            'nama_guru' => $val_char['nama'],
            'tempat_lahir' => $val_char['tempat_lahir'],
            'tanggal_lahir' => $val_char['tgl_lahir'],
            'alamat_guru' => $val_char['alamat'],
            'notelp_guru' => $val_char['telepon'],
            'status_kepegawaian' => $val_char['status'],
            'isActive' => '1'
        ])->where('nuptk', $request->nuptk)->save();
        Flasher::setFlash('Berhasil Diubah!', 'success');
        header('location: ' . base_url . 'guru/ubah/' . $request->nuptk);
        exit();
    }
    public function delete(Request $request)
    {
        ModelsGuru::update([
            'isActive' => 0
        ])->where('nuptk', $request->nuptk)->save();
        Flasher::setFlash('Berhasil Dihapus', 'success');
        header('location: ' . base_url . 'guru');
        exit();
    }
// public function insert(Request $request)
// {
//     return view(['templates/header', 'templates/sidebar', 'guru', 'templates/footer'], [
//         'title' => 'Guru',
//         'name' => 'Riyu'
//     ]);
// }
}