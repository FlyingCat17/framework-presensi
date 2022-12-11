<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Jadwal
{
    public function pelajaran(Request $request)
    {
        $this->rule($request);

        $id = $request->id;

        // try {
        //     $jadwal = Jadwal::where('id', $id)->first();
        // } catch (\Throwable $th) {
        //     return Response::json(500, 'Terjadi kesalahan');
        // }

        // if (!$jadwal) {
        //     return Response::json(404, 'Jadwal tidak ditemukan');
        // } else {
        //     return Response::json(200, 'Jadwal ditemukan', $this->map($jadwal));
        // }
    }

    public function ujian(Request $request)
    {
        $this->rule($request);
    }

    public function presensi(Request $request)
    {
        $this->rule($request);
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