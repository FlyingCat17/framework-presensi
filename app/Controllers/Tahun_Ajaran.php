<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use App\Models\Informasi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Tahun_Ajaran as ModelsTahunAjaran;
use Utils\Flasher;
use Riyu\Validation\Validation;
use Riyu\Helpers\Errors\ViewError;

class Tahun_Ajaran extends Controller
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
        $data['title'] = "Tahun Ajaran";
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('status', 1)->all();
        return view(['templates/header', 'templates/sidebar', 'tahun_ajaran/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Tahun Ajaran";
        return view(['templates/header', 'templates/sidebar', 'tahun_ajaran/tambah', 'templates/footer'], $data);
    }
    public function insert(Request $request)
    {
        if (!isset($_POST['submit_insert'])) {
            header('Location: ' . base_url . 'tahun_ajaran');
            exit();
        }

        $errors = Validation::make($request->all(), [
            'new_tahun_ajaran' => 'required|min:8|max:10',
        ]);
        $filter_tahun_ajaran = htmlspecialchars($request->new_tahun_ajaran);
        if ($errors) {
            Flasher::setFlash('Gagal Ditambahkan! ' . $errors['new_tahun_ajaran'][0], 'danger');
            header('Location: ' . base_url . 'tahun_ajaran/tambah');
            exit();
        }
        ModelsTahunAjaran::insert([
            'tahun_ajaran' => $filter_tahun_ajaran,
            'isActive' => 0,
            'status' => '1',
        ])->save();

        Flasher::setFlash('Berhasil Ditambahkan!', 'success');
        header('Location: ' . base_url . 'tahun_ajaran');
        exit();
    }

    public function ubah(Request $request)
    {
        $data['tahun_ajaran'] = ModelsTahunAjaran::where('id_tahun_ajaran', $request->id)->first();
        if ($data['tahun_ajaran'] == null) {
            header("Location: " . base_url . "tahun_ajaran");
            exit();
        }
        $data['title'] = "Tahun Ajaran";
        return view(['templates/header', 'templates/sidebar', 'tahun_ajaran/update', 'templates/footer'], $data);
    }

    public function update(Request $request)
    {
        $errors = Validation::make($request->all(), [
            'update_tahun_ajaran' => 'required|min:8|max:10',
        ]);
        $filter_tahun_ajaran = htmlspecialchars($request->update_tahun_ajaran);

        if ($errors) {
            Flasher::setFlash('Gagal Ditambahkan! ' . $errors['new_tahun_ajaran'][0], 'danger');
            header('Location: ' . base_url . 'tahun_ajaran/tambah');
            exit();
        }
        ModelsTahunAjaran::update([
            'tahun_ajaran' => $filter_tahun_ajaran,
        ])->where('id_tahun_ajaran', $request->id)->save();

        Flasher::setFlash('Berhasil Diubah!', 'success');
        header('Location: ' . base_url . 'tahun_ajaran');
        exit();
    }

    public function delete(Request $request)
    {
        if (!isset($_POST['submit_hapus'])) {
            header('Location: ' . base_url . 'tahun_ajaran');
            exit();
        }
        ModelsTahunAjaran::update([
            'status' => 0,
        ])->where('id_tahun_ajaran', $request->id)->save();
        Flasher::setFlash('Berhasil Dihapus', 'success');
        header('Location: ' . base_url . 'tahun_ajaran');
        exit();
    }

    public function setActive(Request $request)
    {
        if (!isset($_POST['submit_active'])) {
            header('Location: ' . base_url . 'tahun_ajaran');
            exit();
        }
        ModelsTahunAjaran::update([
            'isActive' => 0
        ])->save();
        ModelsTahunAjaran::update([
            'isActive' => 1
        ])->where('id_tahun_ajaran', $request->id_tahun)->save();

        Flasher::setFlash('Berhasil Diaktifkan', 'success');
        header('Location: ' . base_url . 'tahun_ajaran');
        exit();
    }
}