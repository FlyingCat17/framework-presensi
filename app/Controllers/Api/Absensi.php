<?php
namespace App\Controllers\Api;

use App\Models\Detail_Presensi;
use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Absensi
{
    public function log(Request $request)
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

        $id = $request->id;

        try {
            Siswa::findorfail($id, 'nis', function(){
                return Response::json(404, 'Siswa tidak ditemukan');
            });
            $log = Detail_Presensi::where('nis', $id)->limit(10)->get();
            return Response::json(200, 'Log presensi ditemukan', $log);
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function presensi(Request $request)
    {
        $rule = [
            'idPresensi' => 'required|numeric',
            'nis' => 'required|numeric',
            'kehadiran' => 'required|numeric',
            'timestamp' => 'required|numeric',
            'koodinat' => 'required'
        ];
    }
}