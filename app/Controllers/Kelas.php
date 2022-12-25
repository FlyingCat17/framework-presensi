<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Config\Session;
use App\Models\User;
use Riyu\Http\Request;
use Utils\Flasher;
use Riyu\Validation\Validation;
use App\Models\Kelas as ModelsKelas;

class Kelas extends Controller
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
        $data['title'] = "Kelas";
        $data['kelas'] = ModelsKelas::where('status', '1')->all();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'kelas/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Kelas";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'kelas/tambah', 'templates/footer'], $data);
    }

    public function insert(Request $request)
    {
        $check = ModelsKelas::where('nama_kelas', $request->kelas)->first();
        if ($check) {
            Flasher::setFlash('Nama Kelas sudah tersedia!', 'danger');
            header('location: ' . base_url . 'kelas/tambah');
            exit();
        }
        $val = Validation::make($request->all(), [
            'kelas' => 'required|max:12'
        ]);
        if ($val) {
            Flasher::setFlash('Gagal Ditambahkan!', 'danger');
            header('location: ' . base_url . 'kelas/tambah');
            exit();
        }
        $validatechar = [
            'kelas' => htmlspecialchars($request->kelas)
        ];
        ModelsKelas::insert([
            'id_kelas' => '',
            'nama_kelas' => $validatechar['kelas'],
            'status' => '1'
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan!', 'success');
        header('location: ' . base_url . 'kelas/tambah');
        exit();
    }
    public function ubah(Request $request)
    {
        $check = ModelsKelas::where('id_kelas', $request->id)->get();

        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        if (!$check) {
            header('Location: ' . base_url . 'kelas');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['title'] = 'Kelas';
        $data['kelas'] = ModelsKelas::where('id_kelas', $request->id)->first();
        return view(['templates/header', 'templates/sidebar', 'kelas/edit', 'templates/footer'], $data);
    }
    public function update(Request $request)
    {
        $check = ModelsKelas::where('nama_kelas', $request->kelas)->first();
        if ($check) {
            Flasher::setFlash('Nama Kelas sudah tersedia!', 'danger');
            header('location: ' . base_url . 'kelas/tambah');
            exit();
        }
        $val = Validation::make($request->all(), [
            'kelas' => 'required|max:12'
        ]);
        if ($val) {
            Flasher::setFlash('Gagal Diubah!', 'danger');
            header('location: ' . base_url . 'kelas/ubah/' . $request->id);
            exit();
        }
        $validatechar = [
            'kelas' => htmlspecialchars($request->kelas)
        ];

        ModelsKelas::update([
            'nama_kelas' => $validatechar['kelas']
        ])->where('id_kelas', $request->id)->save();

        Flasher::setFlash('Berhasil Diubah!', 'success');
        header('location: ' . base_url . 'kelas/ubah/' . $request->id);
        exit();
    }

    public function delete(Request $request)
    {
        ModelsKelas::update([
            'status' => 0,
        ])->where('id_kelas', $request->id)->save();
        Flasher::setFlash('Berhasil Dihapus!', 'success');
        header('location: ' . base_url . 'kelas');
        exit();
    }
}