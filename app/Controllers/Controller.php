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
}
