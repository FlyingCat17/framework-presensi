<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use App\Models\Informasi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;

class Admin extends Controller
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
        $data['title'] = "Dashboard";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['siswa'] = Siswa::select('COUNT(nis) AS jumlah_siswa')->where('status', '1')->first();
        $data['guru'] = Guru::select('COUNT(nuptk) AS jumlah_guru')->first();
        return view(['templates/header', 'templates/sidebar', 'home/index', 'templates/footer'], $data);
    }
}