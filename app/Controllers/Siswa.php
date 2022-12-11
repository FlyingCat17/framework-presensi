<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use Utils\Flasher;
use Riyu\Validation\Validation;
use App\Models\Siswa as ModelsSiswa;

class Siswa extends Controller
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
        $data['title'] = "Siswa";
        $data['data_siswa'] = ModelsSiswa::where('status', '1')->orderby('nama_siswa', 'asc')->all();
        return view(['templates/header', 'templates/sidebar', 'siswa/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Siswa";
        $data['data_siswa'] = ModelsSiswa::where('status', '1')->all();
        return view(['templates/header', 'templates/sidebar', 'siswa/tambah', 'templates/footer'], $data);
    }

    public function insert(Request $request)
    {
        if (!isset($_POST['submit_insert'])) {
            header('Location : ' . base_url . 'siswa');
            exit();
        }
        $errors = Validation::make($request->all(), [
            'nis' => 'required|min:4|max:15',
            'nama' => 'required|min:3|max:120',
            'alamat' => 'required|min:10|max:120',
            'telepon' => 'required|min:10|max:14',
            'jk' => 'required',
            'tempat_lahir' => 'required|max:25',
        ]);
        $valiadatechars = [
            'nis' => htmlspecialchars($request->nis),
            'nama' => htmlspecialchars($request->nama),
            'alamat' => htmlspecialchars($request->alamat),
            'telepon' => htmlspecialchars($request->telepon),
            'jk' => htmlspecialchars($request->jk),
            'tempat_lahir' => htmlspecialchars($request->tempat_lahir),
        ];
        if ($errors) {
            Flasher::setFlash('Gagal Ditambahkan!', 'danger');
            header('location: ' . base_url . 'siswa/tambah');
            exit();
        }
        $phone = $valiadatechars['telepon'];
        // echo $phone;
        if (!is_numeric($phone)) {
            Flasher::setFlash('Gagal Ditambahkan! Nomor Telepon harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'siswa/tambah');
            exit();
        }

        ModelsSiswa::insert([
            'nis' => $valiadatechars['nis'],
            'nama_siswa' => $valiadatechars['nama'],
            'alamat_siswa' => $valiadatechars['alamat'],
            'notelp_siswa' => $phone,
            'jenis_kelamin' => $valiadatechars['jk'],
            'tempat_lahir' => $valiadatechars['tempat_lahir'],
            'tanggal_lahir' => $request->tgl_lahir,
            'status' => 1,
            'password' => password_hash($valiadatechars['nis'], PASSWORD_BCRYPT)
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan', 'success');
        header('location: ' . base_url . 'siswa/tambah');
        exit();
    }
}
