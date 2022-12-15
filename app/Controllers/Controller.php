<?php

namespace App\Controllers;

use Utils\Flasher;

class Controller
{
    public function __construct()
    {
        // if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
        //     Flasher::setFlash('Silahkan Login terlebih dahulu!',  'warning');
        //     return redirect('/login');
        // }
    }

    public function respond($view, $data)
    {
        return view([
            'templates/header',
            'templates/sidebar',
            $view,
            'templates/footer',
        ], $data);
    }
}
