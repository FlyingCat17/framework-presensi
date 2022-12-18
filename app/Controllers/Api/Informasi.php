<?php
namespace App\Controllers\Api;

use App\Models\Informasi as ModelsInformasi;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Informasi
{
    public function index()
    {
        try {
            $informasi = ModelsInformasi::orderby('id_informasi', 'desc')->limit(10)->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        return Response::json(200, 'Berhasil mengambil data', $informasi);
    }
}