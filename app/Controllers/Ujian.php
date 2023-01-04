<?php

namespace App\Controllers;

use App\Config\Session;
use App\Models\User;

use Riyu\Helpers\Errors\AppException;
use Riyu\Http\Request;


class Ujian extends Controller
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
}
?>