<?php
namespace App\Controllers;

use App\Config\Session;
use App\Controllers\Controller;
use Riyu\Http\Request;
use App\Models\Mapel as ModelsMapel;
use App\Models\User;
use Riyu\Validation\Validation;
use Utils\Flasher;

class MapelController extends Controller
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
    public function index()
    {
        $data['title'] = "Mata Pelajaran";
        $data['mapel'] = ModelsMapel::where('status', '1')->all();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'pelajaran/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Mata Pelajaran";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'pelajaran/tambah', 'templates/footer'], $data);
    }

    public function insert(Request $request)
    {
        echo json_encode($request->all());
        if ($request->mapel == "" || null) {
            Flasher::setFlash('Harap isi kolom Mata Pelajaran', 'danger');
            header('location: ' . base_url . 'mapel/tambah');
            exit();
        }
        $val = Validation::make($request->all(), [
            'mapel' => 'required|max:35'
        ]);
        if ($val) {
            Flasher::setFlash('Gagal Ditambahkan! Cek Mata Pelajaran {Maksimal : 35 Karakter}', 'danger');
            header('location: ' . base_url . 'mapel/tambah');
            exit();
        }
        $validatechar = [
            'mapel' => htmlspecialchars($request->mapel)
        ];
        ModelsMapel::insert([
            'id_mapel' => '',
            'nama_mapel' => $validatechar['mapel'],
            'status' => '1'
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan!', 'success');
        header('location: ' . base_url . 'mapel/tambah');
        exit();
    }
    public function ubah(Request $request)
    {
        $data['title'] = "Mata Pelajaran";
        $data['mapel'] = ModelsMapel::where('id_mapel', $request->id)->first();
        if (!$data['mapel']) {
            header('location: ' . base_url . 'mapel');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        return view(['templates/header', 'templates/sidebar', 'pelajaran/edit', 'templates/footer'], $data);
    }

    public function update(Request $request)
    {
        $val = Validation::make($request->all(), [
            'mapel' => 'required|max:35'
        ]);
        if ($val) {
            Flasher::setFlash('Gagal Diubah! Cek Mata Pelajaran {Maksimal : 35 Karakter}', 'danger');
            header('location: ' . base_url . 'mapel/tambah');
            exit();
        }
        $validatechar = [
            'mapel' => htmlspecialchars($request->mapel)
        ];
        ModelsMapel::update([
            'nama_mapel' => $validatechar['mapel'],
            'status' => '1'
        ])->where('id_mapel', $request->id)->save();
        Flasher::setFlash('Berhasil Diubah!', 'success');
        header('location: ' . base_url . 'mapel/ubah/' . $request->id);
        exit();
    }

    public function delete(Request $request)
    {
        ModelsMapel::update([
            'status' => 0
        ])->where('id_mapel', $request->id)->save();
        Flasher::setFlash('Berhasil Dihapus!', 'success');
        header('location: ' . base_url . 'mapel');
        exit();
    }

}