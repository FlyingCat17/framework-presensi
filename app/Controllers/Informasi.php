<?php

namespace App\Controllers;

use App\Models\Informasi as ModelsInformasi;

class Informasi extends Controller
{
    public function index()
    {
        try {
            $data = ModelsInformasi::all();
            if ($data) {
                echo "data ada";
                return view('informasi', ['data' => $data]);
            } else {
                return view('informasi', ['data' => []]);
            }
        } catch (\Throwable $th) {
            print_r($th);
        }
        // return view('home', $data);
    }
}
