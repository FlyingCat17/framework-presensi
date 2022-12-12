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
            $informasi = ModelsInformasi::orderby('id', 'desc')->limit(10)->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        return Response::json(200, 'Berhasil mengambil data', $informasi);
    }

    public function detail(Request $request)
    {
        $this->rule($request);

        $id = $request->id;

        try {
            $informasi = ModelsInformasi::where('id', $id)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$informasi) {
            return Response::json(404, 'Informasi tidak ditemukan');
        } else {
            return Response::json(200, 'Informasi ditemukan', $informasi);
        }
    }

    private function rule(Request $request)
    {
        $rule = [
            'id' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }
    }
}