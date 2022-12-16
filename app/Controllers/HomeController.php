<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use App\Models\Informasi;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('id', Session::get('user'))->first();
        return view(['templates/header', 'templates/sidebar', 'beranda', 'templates/footer'], [
            'title' => 'Home',
            'name' => 'Riyu',
            'user' => $user,
        ]);
    }

    public function form()
    {
        return view('form', [
            'title' => 'Form',
            'name' => 'Riyu',
        ]);
    }

    public function save(Request $request)
    {
        echo "request";
        echo "<br>";
        print_r($request);
        echo "<br>";
        echo "request";
        echo "<br>";
        // var_dump($request);
        // Informasi::insert([
        //     'judul' => $request->post('judul'),
        //     'isi' => $request->post('isi'),
        // ])->save();
    }

    public function id(Request $request)
    {
        print_r($request->name);
        // print_r($request->id);
    }

    public function profile()
    {
        // $user = User::where('id', Session::getSession('user'))->first();
        $user = User::where('id', Session::getSession('user'))->first();
        return view('account/profile', [
            'title' => 'Profile',
            'name' => 'Riyu',
            'user' => $user,
        ]);
    }
}