<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;

class Absensi extends Controller
{
    public function log(Request $request)
    {
        $this->ruleLogAbsensi($request);

        $this->findSiswa($request->id);
        $log = $this->getLogAbsensi($request->id);
        
        return Response::json(200, 'Log presensi ditemukan', $log);
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