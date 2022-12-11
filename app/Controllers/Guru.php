<?php

namespace App\Controllers;

use App\Models\Guru as ModelsGuru;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;

class Guru extends Controller
{
    public function index()
    {
        $data = ModelsGuru::allGuru();
        if ($data) {
            return view(['templates/header', 'templates/sidebar', 'guru', 'templates/footer'], [
                'title' => 'Guru',
                'data' => $data
            ]);
        } else {
            return ViewError::code(500);
        }
    }

    public function insert(Request $request)
    {
        return view(['templates/header', 'templates/sidebar', 'guru', 'templates/footer'], [
            'title' => 'Guru',
            'name' => 'Riyu'
        ]);
    }
}
